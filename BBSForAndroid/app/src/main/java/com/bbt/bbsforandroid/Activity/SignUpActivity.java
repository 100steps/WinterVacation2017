package com.bbt.bbsforandroid.Activity;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;

import com.bbt.bbsforandroid.R;

/**
 * 注册界面
 * Created by zyt on 2018/1/8.
 */

public class SignUpActivity extends AppCompatActivity{

    private Button titlebar_right_btn;
    private Button sign_up_btn;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);

        titlebar_right_btn = (Button)findViewById(R.id.titlebar_right_btn);
        sign_up_btn = (Button) findViewById(R.id.sign_up_button);
        //将其标题栏注册按钮隐藏
        titlebar_right_btn.setVisibility(View.GONE);
        sign_up_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //网络请求注册
            }
        });
    }
}
