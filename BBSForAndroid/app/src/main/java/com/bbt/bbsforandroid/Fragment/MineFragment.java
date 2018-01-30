package com.bbt.bbsforandroid.Fragment;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.app.Fragment;
import android.support.annotation.Nullable;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.RelativeLayout;

import com.bbt.bbsforandroid.Activity.LoginActivity;
import com.bbt.bbsforandroid.Activity.MineActivity;
import com.bbt.bbsforandroid.Activity.SignUpActivity;
import com.bbt.bbsforandroid.R;

/**
 * 我的 碎片
 * Created by zyt on 2018/1/9.
 */

public class MineFragment extends Fragment{
    private View view;
    private Button login_btn;
    private Button sign_up_btn;
    private Context mContext;
    private RelativeLayout relativeLayout;
    private static final String TAG = "MineFragment";

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        view = inflater.inflate(R.layout.fragment_mine,container, false);
        Log.i(TAG,"MineFragment --> onCreateView");
        mContext = view.getContext();
        login_btn = view.findViewById(R.id.login_button);
        sign_up_btn = view.findViewById(R.id.sign_up_button);
        relativeLayout = view.findViewById(R.id.user);
        relativeLayout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(mContext, MineActivity.class);
                startActivity(intent);
            }
        });
        login_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(mContext, LoginActivity.class);
                startActivity(intent);
            }
        });
        sign_up_btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(mContext, SignUpActivity.class);
                startActivity(intent);
            }
        });
        return view;
    }
}
