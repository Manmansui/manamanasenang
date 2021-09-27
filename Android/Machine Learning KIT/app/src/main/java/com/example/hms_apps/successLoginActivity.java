package com.example.hms_apps;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.huawei.hms.ads.AdListener;
import com.huawei.hms.ads.AdParam;
import com.huawei.hms.ads.HwAds;
import com.huawei.hms.ads.InterstitialAd;


public class successLoginActivity extends AppCompatActivity {

    private TextView textView;
    private Button btn_txt_translator, btn_img_analyzer, btn_face_analyzer;
    private InterstitialAd interstitialAd;
    private boolean already_login;

    private AdListener adListener = new AdListener() {
        @Override
        public void onAdLoaded() {
            super.onAdLoaded();
            showInterstitial();
        }
    };

    @Override
    protected void onStart() {
        super.onStart();
        SharedPreferences sharedPreferences = getSharedPreferences("prefs", MODE_PRIVATE);
        already_login = sharedPreferences.getBoolean("Login", true);
    }

    @Override
    protected void onStop() {
        super.onStop();

        SharedPreferences prefs = getSharedPreferences("prefs", MODE_PRIVATE);
        SharedPreferences.Editor editor = prefs.edit();
        editor.putBoolean("Login", false);
        editor.apply();

    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_success_login);

        textView = findViewById(R.id.txt_view);


        //============================
        HwAds.init(this);
        loadInterstitialAd();
        //============================

        btn_txt_translator = findViewById(R.id.btn_txt_translator);
        btn_img_analyzer = findViewById(R.id.btn_img_analyzer);
        btn_face_analyzer = findViewById(R.id.btn_face_analyzer);

        btn_txt_translator.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(successLoginActivity.this, Text_Translation.class);
                startActivity(intent);
            }
        });

        btn_img_analyzer.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(successLoginActivity.this, TextAnalyzer.class);
                startActivity(intent);
            }
        });

        btn_face_analyzer.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(successLoginActivity.this, Face_Detection.class);
                startActivity(intent);
            }
        });

        String newString;
        if (savedInstanceState == null) {
            Bundle extras = getIntent().getExtras();
            if (extras == null) {
                newString = null;
            } else {
                newString = extras.getString("STRING_I_NEED");
            }
        } else {
            newString = (String) savedInstanceState.getSerializable("STRING_I_NEED");
        }
        if (already_login) {
            Toast.makeText(this, "Welcome " + newString + "!", Toast.LENGTH_SHORT).show();
        }

    }

    private void loadInterstitialAd() {
        interstitialAd = new InterstitialAd(this);
        interstitialAd.setAdId("teste9ih9j0rc3");
        interstitialAd.setAdListener(adListener);

        AdParam adParam = new AdParam.Builder().build();
        interstitialAd.loadAd(adParam);
    }

    private void showInterstitial() {
        // Display an interstitial ad.
        if (interstitialAd != null && interstitialAd.isLoaded()) {
            interstitialAd.show();
        } else {
            Toast.makeText(this, "Ad did not load", Toast.LENGTH_SHORT).show();
        }
    }
}