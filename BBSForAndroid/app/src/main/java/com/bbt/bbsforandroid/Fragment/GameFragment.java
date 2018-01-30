package com.bbt.bbsforandroid.Fragment;


import android.os.Bundle;
import android.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.bbt.bbsforandroid.R;

/**
 * Created by zyt on 2018/1/8.
 */

public class GameFragment extends Fragment {

    private View viewCourse;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        viewCourse = inflater.inflate(R.layout.fragment_game,container, false);
        return viewCourse;
    }

}
