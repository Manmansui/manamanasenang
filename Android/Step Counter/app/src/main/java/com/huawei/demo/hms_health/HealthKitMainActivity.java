/*
 * Copyright 2020. Huawei Technologies Co., Ltd. All rights reserved.

 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at

 *   http://www.apache.org/licenses/LICENSE-2.0

 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

package com.huawei.demo.hms_health;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.huawei.demo.hms_health.auth.HealthKitAuthActivity;
import com.huawei.health.demo.R;
import com.huawei.hms.ads.AdListener;
import com.huawei.hms.ads.AdParam;
import com.huawei.hms.ads.banner.BannerView;

import java.util.Locale;

public class HealthKitMainActivity extends AppCompatActivity {
    private static final String TAG = "KitConnectActivity";
    private static final int REFRESH_TIME = 60;


    private HealthKitAuthActivity authentication = new HealthKitAuthActivity();
    private Button login_btn;
    private boolean user_login = false;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_health_kit_main);

        login_btn = findViewById(R.id.button_login);
    }

    private void showToast(String message) {
        Toast.makeText(HealthKitMainActivity.this, message, Toast.LENGTH_SHORT).show();
    }

    @Override
    protected void onStart() {
        super.onStart();

        user_login = authentication.getAuthResult();

        if(user_login){
            login_btn.setVisibility(View.GONE);
        }else{
            login_btn.setVisibility(View.VISIBLE);
        }
    }

    /**
     * Data Controller
     *
     * @param view UI object
     */
    public void hihealthDataControllerOnclick(View view) {
        Intent intent = new Intent(this, HealthKitDataControllerActivity.class);
        startActivity(intent);
    }

    /**
     * Auto Recorder
     *
     * @param view UI object
     */
    public void hihealthAutoRecorderOnClick(View view) {
        Intent intent = new Intent(this, HealthKitAutoRecorderControllerActivity.class);
        startActivity(intent);
    }

    /**
     * signing In and applying for Scopes, and enable the health app authorization.
     *
     * @param view UI object
     */
    public void onLoginClick(View view) {
        Intent intent = new Intent(this, HealthKitAuthActivity.class);
        startActivity(intent);
    }
}
