package com.example.hms_apps;

import android.util.SparseArray;

import com.huawei.hms.mlsdk.common.MLAnalyzer;
import com.huawei.hms.mlsdk.face.MLFace;
import com.example.hms_apps.GraphicOverlay;
import com.example.hms_apps.MLFaceGraphic;


public class FaceAnalyzerTransactor implements MLAnalyzer.MLTransactor<MLFace> {
    private GraphicOverlay mGraphicOverlay;

    FaceAnalyzerTransactor(GraphicOverlay ocrGraphicOverlay) {
        this.mGraphicOverlay = ocrGraphicOverlay;
    }

    @Override
    public void transactResult(MLAnalyzer.Result<MLFace> result) {
        this.mGraphicOverlay.clear();
        SparseArray<MLFace> faceSparseArray = result.getAnalyseList();
        for (int i = 0; i < faceSparseArray.size(); i++) {
            // todo step 4: add on-device face graphic
                MLFaceGraphic graphic = new MLFaceGraphic(mGraphicOverlay,faceSparseArray.valueAt(i));
                mGraphicOverlay.add(graphic);
            // finish
        }
    }

    @Override
    public void destroy() {
        this.mGraphicOverlay.clear();
    }

}
