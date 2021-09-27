package com.example.hms_apps;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Pair;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.huawei.hmf.tasks.OnFailureListener;
import com.huawei.hmf.tasks.OnSuccessListener;
import com.huawei.hmf.tasks.Task;
import com.huawei.hms.mlsdk.common.MLApplication;
import com.huawei.hms.mlsdk.translate.MLTranslatorFactory;
import com.huawei.hms.mlsdk.translate.cloud.MLRemoteTranslateSetting;
import com.huawei.hms.mlsdk.translate.cloud.MLRemoteTranslator;
import com.huawei.hms.mlsdk.tts.MLTtsAudioFragment;
import com.huawei.hms.mlsdk.tts.MLTtsCallback;
import com.huawei.hms.mlsdk.tts.MLTtsConfig;
import com.huawei.hms.mlsdk.tts.MLTtsConstants;
import com.huawei.hms.mlsdk.tts.MLTtsEngine;
import com.huawei.hms.mlsdk.tts.MLTtsError;
import com.huawei.hms.mlsdk.tts.MLTtsWarn;

public class Text_Translation extends AppCompatActivity {

    private Button btn_translate, btn_swap_lang, btn_speak;
    private TextView txt_swap_lang;
    private EditText et_input, et_output;
    private boolean swap_lang = true;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_text_translation);


        btn_translate = findViewById(R.id.btn_translate);
        btn_swap_lang = findViewById(R.id.btn_swap_lang);
        txt_swap_lang = findViewById(R.id.txt_language);
        btn_speak = findViewById(R.id.btn_speak_lang);
        et_input = findViewById(R.id.et_input);
        et_output = findViewById(R.id.et_output);

        btn_swap_lang.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                et_input.getText().clear();
                et_output.getText().clear();
                swap_lang = !swap_lang;
                if (!swap_lang) {
                    txt_swap_lang.setText("Chinese -> English");
                } else {
                    txt_swap_lang.setText("English -> Chinese");
                }
            }
        });

        btn_translate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (swap_lang) {
                    remoteTranslator_english_to_chinese(et_input.getText().toString());
                } else {
                    remoteTranslator_chinese_to_english(et_input.getText().toString());
                }
            }
        });

        btn_speak.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (swap_lang) {
                    chinese_speaking(et_output.getText().toString());
                } else {
                    english_speaking(et_output.getText().toString());
                }
            }
        });


    }


    private void chinese_speaking(String sourceText){
        MLApplication.getInstance().setApiKey(getResources().getString(R.string.api_key));
        MLTtsConfig mlTtsConfig = new MLTtsConfig()
                // Set the text converted from speech to Chinese.
                .setLanguage("zh-Hans")
                // Set the Chinese timbre.
                .setPerson(MLTtsConstants.TTS_SPEAKER_FEMALE_ZH)
                // Set the speech speed. The range is (0, 5.0]. 1.0 indicates a normal speed.
                .setSpeed(1.0f)
                // Set the volume. The range is (0, 2). 1.0 indicates a normal volume.
                .setVolume(1.0f);

        MLTtsEngine mlTtsEngine = new MLTtsEngine(mlTtsConfig);
        // Set the volume of the built-in player, in dBs. The value is in the range of [0, 100].
        mlTtsEngine.setPlayerVolume(20);
        // Update the configuration when the engine is running.
        mlTtsEngine.updateConfig(mlTtsConfig);
        mlTtsEngine.setTtsCallback(callback);

        mlTtsEngine.speak(sourceText, MLTtsEngine.QUEUE_APPEND);

    }

    private void english_speaking(String sourceText){
        MLApplication.getInstance().setApiKey(getResources().getString(R.string.api_key));
        MLTtsConfig mlTtsConfig = new MLTtsConfig()
                // Set the text converted from speech to Chinese.
                .setLanguage("en-US")
                // Set the Chinese timbre.
                .setPerson(MLTtsConstants.TTS_SPEAKER_FEMALE_EN)
                // Set the speech speed. The range is (0, 5.0]. 1.0 indicates a normal speed.
                .setSpeed(1.0f)
                // Set the volume. The range is (0, 2). 1.0 indicates a normal volume.
                .setVolume(1.0f);

        MLTtsEngine mlTtsEngine = new MLTtsEngine(mlTtsConfig);
        // Set the volume of the built-in player, in dBs. The value is in the range of [0, 100].
        mlTtsEngine.setPlayerVolume(20);
        // Update the configuration when the engine is running.
        mlTtsEngine.updateConfig(mlTtsConfig);
        mlTtsEngine.setTtsCallback(callback);

        mlTtsEngine.speak(sourceText, MLTtsEngine.QUEUE_APPEND);
    }


    MLTtsCallback callback = new MLTtsCallback() {
        @Override
        public void onError(String taskId, MLTtsError err) {
            // Processing logic for TTS failure.
        }

        @Override
        public void onWarn(String taskId, MLTtsWarn warn) {
            // Alarm handling without affecting service logic.
        }

        @Override
        public void onRangeStart(String taskId, int start, int end) {
            // Process the mapping between the currently played segment and text.
        }

        @Override
        public void onAudioAvailable(String s, MLTtsAudioFragment mlTtsAudioFragment, int i, Pair<Integer, Integer> pair, Bundle bundle) {
            //  Audio stream callback API, which is used to return the synthesized audio data to the app.
            //  taskId: ID of an audio synthesis task corresponding to the audio.
            // audioFragment: audio data.
            // offset: offset of the audio segment to be transmitted in the queue. One audio synthesis task corresponds to an audio synthesis queue.
            //  range: text area where the audio segment to be transmitted is located; range.first (included): start position; range.second (excluded): end position.
        }

        @Override
        // Callback method of a TTS event. eventName: event name. The events are as follows:
        // MLTtsConstants.EVENT_PLAY_RESUME: playback resumption.
        // MLTtsConstants.EVENT_PLAY_PAUSE: playback pause.
        // MLTtsConstants.EVENT_PLAY_STOP: playback stop.
        public void onEvent(String taskId, int eventId, Bundle bundle) {
            String str = "TaskID: " + taskId + ", eventName:" + eventId;
            // Callback method of an audio synthesis event. eventId: event name.
            switch (eventId) {
                case MLTtsConstants.EVENT_PLAY_START:
                    //  Called when playback starts.
                    break;
                case MLTtsConstants.EVENT_PLAY_STOP:
                    // Called when playback stops.
                    boolean isInterrupted = bundle.getBoolean(MLTtsConstants.EVENT_PLAY_STOP_INTERRUPTED);
                    str += " " + isInterrupted;
                    break;
                case MLTtsConstants.EVENT_PLAY_RESUME:
                    //  Called when playback resumes.
                    break;
                case MLTtsConstants.EVENT_PLAY_PAUSE:
                    // Called when playback pauses.
                    break;

                /*//Pay attention to the following callback events when you focus on only synthesized audio data but do not use the internal player for playback:
                case MLTtsConstants.EVENT_SYNTHESIS_START:
                    //  Called when TTS starts.
                    break;
                case MLTtsConstants.EVENT_SYNTHESIS_END:
                    // Called when TTS ends.
                    break;
                case MLTtsConstants.EVENT_SYNTHESIS_COMPLETE:
                    // TTS is complete. All synthesized audio streams are passed to the app.
                    boolean isInterrupted = bundle.getBoolean(MLTtsConstants.EVENT_SYNTHESIS_INTERRUPTED);
                    break;*/
                default:
                    break;
            }
        }
    };

    private void remoteTranslator_english_to_chinese(String sourceText) {
        MLApplication.getInstance().setApiKey(getResources().getString(R.string.api_key));
        MLRemoteTranslateSetting setting =
                new MLRemoteTranslateSetting
                        .Factory()
                        .setSourceLangCode("en")
                        .setTargetLangCode("zh")
                        .create();
        MLRemoteTranslator remoteTranslator = MLTranslatorFactory.getInstance().getRemoteTranslator(setting);
        Task<String> task = remoteTranslator.asyncTranslate(sourceText);
        task.addOnSuccessListener(new OnSuccessListener<String>() {
            @Override
            public void onSuccess(String text) {
                et_output.setText(text);
                Toast.makeText(getApplicationContext(), "Success translating...", Toast.LENGTH_SHORT).show();
            }

        }).addOnFailureListener(new OnFailureListener() {
            @Override
            public void onFailure(Exception e) {
                Toast.makeText(getApplicationContext(), "Failed translating...", Toast.LENGTH_SHORT).show();
            }
        });
    }

    private void remoteTranslator_chinese_to_english(String sourceText) {
        MLApplication.getInstance().setApiKey(getResources().getString(R.string.api_key));
        MLRemoteTranslateSetting setting =
                new MLRemoteTranslateSetting
                        .Factory()
                        .setSourceLangCode("zh")
                        .setTargetLangCode("en")
                        .create();
        MLRemoteTranslator remoteTranslator = MLTranslatorFactory.getInstance().getRemoteTranslator(setting);
        Task<String> task = remoteTranslator.asyncTranslate(sourceText);
        task.addOnSuccessListener(new OnSuccessListener<String>() {
            @Override
            public void onSuccess(String text) {
                et_output.setText(text);
                Toast.makeText(getApplicationContext(), "Success translating...", Toast.LENGTH_SHORT).show();
            }

        }).addOnFailureListener(new OnFailureListener() {
            @Override
            public void onFailure(Exception e) {
                Toast.makeText(getApplicationContext(), "Failed translating...", Toast.LENGTH_SHORT).show();
            }
        });
    }

}