package com.bbt.bbsforandroid.Activity;

import android.os.Bundle;

import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;

import com.bbt.bbsforandroid.R;

/**
 * 新建帖子
 * Created by zyt on 2018/1/7.
 */

public class NewPostActivity extends AppCompatActivity {

    private Button titlebar_send_btn;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_post_new);

        titlebar_send_btn = (Button) findViewById(R.id.titlebar_right_btn);
        //将其标题栏注册按钮变为发表按钮
        titlebar_send_btn.setText("发表");
        titlebar_send_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //网络请求发表帖子
            }
        });
    }
}
