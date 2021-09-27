package com.example.hms_apps;

import android.Manifest;
import android.content.Context;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.util.Log;
import android.widget.CompoundButton;
import android.widget.ToggleButton;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;

import com.huawei.hms.mlsdk.MLAnalyzerFactory;
import com.huawei.hms.mlsdk.common.LensEngine;
import com.huawei.hms.mlsdk.face.MLFaceAnalyzer;
import com.example.hms_apps.GraphicOverlay;
import com.example.hms_apps.CameraSourcePreview;
import com.huawei.hms.mlsdk.face.MLFaceAnalyzerSetting;


import java.io.IOException;

public class Face_Detection extends AppCompatActivity implements CompoundButton.OnCheckedChangeListener {
    private static final String TAG = "LiveImageDetection";

    private static final int CAMERA_PERMISSION_CODE = 2;
    MLFaceAnalyzer analyzer;
    private LensEngine mLensEngine;
    private CameraSourcePreview mPreview;
    private GraphicOverlay mOverlay;
    private int lensType = LensEngine.BACK_LENS;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.setContentView(R.layout.activity_face_detection);

        this.mPreview = this.findViewById(R.id.preview);
        this.mOverlay = this.findViewById(R.id.overlay);
        this.createFaceAnalyzer();
        ToggleButton facingSwitch = this.findViewById(R.id.facingSwitch);
        facingSwitch.setOnCheckedChangeListener(this);
        // Checking Camera Permissions
        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.CAMERA) == PackageManager.PERMISSION_GRANTED) {
            this.createLensEngine();
        } else {
            this.requestCameraPermission();
        }
    }

    private void requestCameraPermission() {
        final String[] permissions = new String[]{Manifest.permission.CAMERA};

        if (!ActivityCompat.shouldShowRequestPermissionRationale(this,
                Manifest.permission.CAMERA)) {
            ActivityCompat.requestPermissions(this, permissions, Face_Detection.CAMERA_PERMISSION_CODE);
            return;
        }
    }

    @Override
    protected void onResume() {
        super.onResume();
        this.startLensEngine();
    }

    @Override
    protected void onPause() {
        super.onPause();
        this.mPreview.stop();
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        if (this.mLensEngine != null) {
            this.mLensEngine.release();
        }
        if (this.analyzer != null) {
            this.analyzer.destroy();
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions,
                                           @NonNull int[] grantResults) {
        if (requestCode != Face_Detection.CAMERA_PERMISSION_CODE) {
            super.onRequestPermissionsResult(requestCode, permissions, grantResults);
            return;
        }
        if (grantResults.length != 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
            this.createLensEngine();
            return;
        }
    }

    @Override
    public void onSaveInstanceState(Bundle savedInstanceState) {
        super.onSaveInstanceState(savedInstanceState);
    }


    @Override
    public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
        if (this.mLensEngine != null) {
            if (isChecked) {
                this.lensType = LensEngine.FRONT_LENS;
            } else {
                this.lensType = LensEngine.BACK_LENS;
            }
        }
        this.mLensEngine.close();
        this.createLensEngine();
        this.startLensEngine();
    }

    private MLFaceAnalyzer createFaceAnalyzer() {
        // todo step 2: add on-device face analyzer
        MLFaceAnalyzerSetting setting = new MLFaceAnalyzerSetting.Factory()
                .setFeatureType(MLFaceAnalyzerSetting.TYPE_FEATURES)
                .allowTracing()
                .create();

        analyzer = MLAnalyzerFactory.getInstance().getFaceAnalyzer(setting);
        // finish
        this.analyzer.setTransactor(new FaceAnalyzerTransactor(this.mOverlay));
        return this.analyzer;
    }

    private void createLensEngine() {
        Context context = this.getApplicationContext();
        // todo step 3: add on-device lens engine
        this.mLensEngine = new LensEngine.Creator(context, this.analyzer)
                .setLensType(this.lensType)
                .applyDisplayDimension(640, 480)
                .applyFps(25.0f)
                .enableAutomaticFocus(true)
                .create();

        // finish
    }


    private void startLensEngine() {
        if (this.mLensEngine != null) {
            try {
                this.mPreview.start(this.mLensEngine, this.mOverlay);
            } catch (IOException e) {
                Log.e(Face_Detection.TAG, "Failed to start lens engine.", e);
                this.mLensEngine.release();
                this.mLensEngine = null;
            }
        }
    }
}