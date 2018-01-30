package com.bbt.bbsforandroid.Activity;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.bbt.bbsforandroid.R;

/**
 * 我的个人信息界面，修改个人信息暂未设置
 * Created by zyt on 2018/1/24.
 */

public class MineActivity extends AppCompatActivity {

    private Button right_btn;
    private RelativeLayout user_name_title;
    private RelativeLayout user_gender_title;
    private RelativeLayout user_email_title;
    private TextView user_name;
    private TextView user_gender;
    private TextView user_email;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mine);

        right_btn = (Button) findViewById(R.id.titlebar_right_btn);
        right_btn.setVisibility(View.GONE);
        //修改功能暂未设置
        user_name_title = findViewById(R.id.user_name_title);
        user_email_title = findViewById(R.id.user_email_title);
        user_gender_title = findViewById(R.id.user_gender_title);

        user_name = findViewById(R.id.user_name);
        user_gender = findViewById(R.id.user_gender);
        user_email = findViewById(R.id.user_email);



    }
}
