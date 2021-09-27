package com.example.shootthebird;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.method.CharacterPickerDialog;
import android.view.View;
import android.view.WindowManager;
import android.widget.ImageView;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {
    private boolean isMute;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,
                            WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_main);

        findViewById(R.id.play_button).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(MainActivity.this, GameActivity.class));
            }
        });

        TextView textView = findViewById(R.id.highscore_text);
        SharedPreferences prefs = getSharedPreferences("game", MODE_PRIVATE);
        textView.setText("Highscore: " + prefs.getInt("highscore", 0));

        isMute = prefs.getBoolean("isMute", false);
        ImageView volumeCntrl = findViewById(R.id.volume_ctrl);

        if(isMute)
            volumeCntrl.setImageResource(R.drawable.ic_baseline_volume_off_24);
        else
            volumeCntrl.setImageResource(R.drawable.volume_up);

        volumeCntrl.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                isMute = !isMute;
                if(isMute)
                    volumeCntrl.setImageResource(R.drawable.ic_baseline_volume_off_24);
                else
                    volumeCntrl.setImageResource(R.drawable.volume_up);

                SharedPreferences.Editor editor = prefs.edit();
                editor.putBoolean("isMute", isMute);
                editor.apply();
            }
        });
    }
}