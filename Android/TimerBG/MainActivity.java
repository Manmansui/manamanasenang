package com.example.timerbg;

import android.content.SharedPreferences;
import android.os.CountDownTimer;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import java.util.Locale;

public class MainActivity extends AppCompatActivity {
    private static final long START_TIME_IN_MILLIS = 60000;

    private int resin_count = 0;

    private TextView mTextViewCountDown, resin_text;
    private Button mButtonStartPause;
    private Button mButtonReset;

    private CountDownTimer mCountDownTimer;

    private boolean mTimerRunning;

    private long mTimeLeftInMillis;
    private long mEndTime;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        mTextViewCountDown = findViewById(R.id.text_view_countdown);
        resin_text = findViewById(R.id.resin_txt);

        mButtonStartPause = findViewById(R.id.button_start_pause);
        mButtonReset = findViewById(R.id.button_reset);

        mButtonStartPause.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (mTimerRunning) {
                    pauseTimer();
                } else {
                    startTimer();
                }
            }
        });

        mButtonReset.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                resetTimer();
            }
        });
    }

    @Override
    protected void onStop() {
        super.onStop();

        SharedPreferences prefs = getSharedPreferences("prefs", MODE_PRIVATE);
        SharedPreferences.Editor editor = prefs.edit();

        editor.putLong("millisLeft", mTimeLeftInMillis);
        editor.putBoolean("timerRunning", mTimerRunning);
        editor.putLong("endTime", mEndTime);
        editor.putInt("resinCount", resin_count);
        editor.putLong("timeWeLeftTheApps", System.currentTimeMillis());

        editor.apply();

        if (mCountDownTimer != null) {
            mCountDownTimer.cancel();
        }
    }


    @Override
    protected void onStart() {
        super.onStart();

        SharedPreferences prefs = getSharedPreferences("prefs", MODE_PRIVATE);

        mTimeLeftInMillis = prefs.getLong("millisLeft", START_TIME_IN_MILLIS);
        mTimerRunning = prefs.getBoolean("timerRunning", false);
        resin_count = prefs.getInt("resinCount", 0);

        updateCountDownText();
        updateResinText();
        updateButtons();

        if (mTimerRunning) { //execute when come back to apps

            long timeLeave = System.currentTimeMillis() - prefs.getLong("timeWeLeftTheApps", 0);

            mEndTime = prefs.getLong("endTime", 0);
            if(mEndTime > System.currentTimeMillis()) {
                mTimeLeftInMillis = mEndTime - System.currentTimeMillis();
            }else{
                if(mTimeLeftInMillis > timeLeave ){
                    mTimeLeftInMillis = mTimeLeftInMillis - timeLeave;// i refer to time period we left the apps
                }else{
//                    mTimeLeftInMillis = 60000 - (timeLeave - mTimeLeftInMillis);//timeLeave=125, mTimeLeftInMillis=39,
                    mTimeLeftInMillis = 60000 - ((timeLeave-mTimeLeftInMillis) % 60000);//Using modulus
                    //resin_count++;
                }
            }


            resin_count = resin_count + (int) (timeLeave / 60000);

            updateCountDownText();
            updateResinText();
            updateButtons();

            if (mTimeLeftInMillis < 0) {
                mTimeLeftInMillis = 60000;//0       //60
//                mTimerRunning = true;
//                resin_count++;
//                resin_text.setText(String.valueOf(resin_count));
//                updateCountDownText();
//                updateResinText();
//                updateButtons();
            }
            startTimer();

        }
    }


    private void startTimer() {
        mEndTime = System.currentTimeMillis() + mTimeLeftInMillis;//==========
        if (mTimeLeftInMillis < 0) {
            mTimeLeftInMillis = START_TIME_IN_MILLIS;
        }
        mCountDownTimer = new CountDownTimer(mTimeLeftInMillis, 1000) {//================
            @Override
            public void onTick(long millisUntilFinished) {
                mTimeLeftInMillis = millisUntilFinished;
                updateCountDownText();
            }

            @Override
            public void onFinish() {

                mTimerRunning = true;
                updateButtons();
                resin_count++;
                updateResinText();
                mTimeLeftInMillis = 60000;//======================
                //mCountDownTimer.start();//
                startTimer();

            }
        }.start();

        mTimerRunning = true;
        updateButtons();
    }


    private void pauseTimer() {
        mCountDownTimer.cancel();
        mTimerRunning = false;
        updateButtons();
    }

    private void resetTimer() {
        mTimeLeftInMillis = START_TIME_IN_MILLIS;
        resin_count = 0;
        updateCountDownText();
        updateResinText();
        updateButtons();
    }

    private void updateCountDownText() {
        int minutes = (int) (mTimeLeftInMillis / 1000) / 60;
        int seconds = (int) (mTimeLeftInMillis / 1000) % 60;

        String timeLeftFormatted = String.format(Locale.getDefault(), "%02d:%02d", minutes, seconds);

        mTextViewCountDown.setText(timeLeftFormatted);
    }

    private void updateResinText() {
        resin_text.setText(String.valueOf(resin_count));
    }

    private void updateButtons() {
        if (mTimerRunning) {
            mButtonReset.setVisibility(View.INVISIBLE);
            mButtonStartPause.setText("Pause");
        } else {
            mButtonStartPause.setText("Start");

//            if (mTimeLeftInMillis < 1000) {
//                mButtonStartPause.setVisibility(View.INVISIBLE);
//            } else {
//                mButtonStartPause.setVisibility(View.VISIBLE);
//            }

            if (mTimeLeftInMillis < START_TIME_IN_MILLIS) {
                mButtonReset.setVisibility(View.VISIBLE);
            } else {
                mButtonReset.setVisibility(View.INVISIBLE);
            }
        }
    }
}

