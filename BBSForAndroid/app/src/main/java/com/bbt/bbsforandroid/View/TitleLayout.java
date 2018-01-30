package com.bbt.bbsforandroid.View;

import android.app.Activity;
import android.content.Context;

import android.util.AttributeSet;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.ImageButton;
import android.widget.RelativeLayout;

import com.bbt.bbsforandroid.R;

/**
 * 自定义标题栏控件
 * 返回以设置，右按钮未设置
 * Created by zyt on 2018/1/27.
 */

public class TitleLayout extends RelativeLayout {
    public TitleLayout(Context context, AttributeSet attrs) {
        super(context, attrs);
        LayoutInflater.from(context).inflate(R.layout.titlebar,this);
        ImageButton back_btn = findViewById(R.id.titlebar_back);
        back_btn.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View view) {
                ((Activity)getContext()).finish();
            }
        });
    }
}
