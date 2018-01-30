package com.bbt.bbsforandroid.Activity;

import android.content.Intent;
import android.os.Bundle;

import android.support.v7.app.AppCompatActivity;
import android.view.KeyEvent;
import android.view.View;
import android.view.inputmethod.EditorInfo;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.bbt.bbsforandroid.R;

/**
 * 登录界面
 * Created by zyt on 2018/1/7.
 */

public class LoginActivity extends AppCompatActivity {

    private Button sign_up_btn;
    private Button login_btn;
    private EditText user_id_edt;
    private EditText user_password_edt;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        sign_up_btn = (Button) findViewById(R.id.titlebar_right_btn);
        login_btn = (Button) findViewById(R.id.login);
        user_id_edt = (EditText) findViewById(R.id.login_user_id);
        user_password_edt = (EditText) findViewById(R.id.login_user_password);
        //back_btn.setAlpha(0f);

        sign_up_btn.setText("注册");
        //EditText password软键盘监听
        user_password_edt.setOnEditorActionListener(new TextView.OnEditorActionListener() {
            @Override
            public boolean onEditorAction(TextView textView, int id, KeyEvent keyEvent) {
                if (id == EditorInfo.IME_ACTION_DONE || id == EditorInfo.IME_NULL) {
                    //进行登录操作
                    login();
                    return true;
                }
                return false;
            }
        });
        login_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                login();
            }
        });

        //注册按钮
        sign_up_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(LoginActivity.this, SignUpActivity.class);
                startActivity(intent);
            }
        });

        login_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                login();
            }
        });
    }

    //下面两个判断是否合法均为测试
    private boolean isIdValid(String id) {
        //id大于等于6
        return id.length() >= 6;
    }

    private boolean isPasswordValid(String password) {
        //密码大于等于6位
        return password.length() >= 6;
    }

    //登录
    private void login() {

        String user_id = user_id_edt.getText().toString();
        String user_password = user_password_edt.getText().toString();

        //重置错误信息
        user_password_edt.setError(null);
        user_id_edt.setError(null);

        if (!isIdValid(user_id)) {
            user_id_edt.setError("请输入合法格式的账号");
        }
        if (!isPasswordValid(user_password)) {
            user_password_edt.setError("请输入合法格式的密码");
        }
        if (isPasswordValid(user_password) && isIdValid(user_id)) {
            Toast.makeText(this, "开始登录操作", Toast.LENGTH_SHORT).show();
        }
    }
}
