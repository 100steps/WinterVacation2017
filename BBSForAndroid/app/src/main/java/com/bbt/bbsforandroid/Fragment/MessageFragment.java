package com.bbt.bbsforandroid.Fragment;

import android.content.Context;
import android.os.Bundle;
import android.app.Fragment;
import android.support.annotation.Nullable;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.bbt.bbsforandroid.R;

/**
 * 消息碎片
 * Created by zyt on 2018/1/9.
 */

public class MessageFragment extends Fragment {
    private static final String TAG = "MessageFragment";
    private View viewCourse;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        viewCourse = inflater.inflate(R.layout.fragment_message, container, false);
        Log.i(TAG, "MessageFragment --> onCreateView");
        return viewCourse;
    }
}
