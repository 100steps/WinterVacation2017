package com.bbt.bbsforandroid.Fragment;

import android.app.Fragment;
import android.content.Context;
import android.os.Bundle;


import android.support.annotation.Nullable;
import android.support.v4.view.ViewPager;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.bbt.bbsforandroid.Adapter.TabPagerAdapter;
import com.bbt.bbsforandroid.R;
import com.bbt.bbsforandroid.View.SlidingTabLayout;


import java.util.ArrayList;
import java.util.List;

/**
 * 内嵌三个碎片提供给viewPager，仿造微信，做出侧滑换页效果
 * Created by zyt on 2018/1/10.
 */

public class PostFragment extends Fragment {

    private static final String TechnologyFragment_TAG = "TechnologyFragment";
    private static final String TAG = "PostFragment";
    private View view;
    private SlidingTabLayout tabLayout;
    private ViewPager viewPager;
    private List<String> titleList;
    private List<Fragment> top_fragList;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        view = inflater.inflate(R.layout.fragment_post, container, false);
        Log.i(TAG, "PostFragment --> onCreateView");
        //onCreateView方法中初始化控件和监听事件
        tabLayout = (SlidingTabLayout) view.findViewById(R.id.top_tablayout);
        viewPager = (ViewPager) view.findViewById(R.id.top_viewpager);
        setupViewPager(viewPager);
        initTabLayout(tabLayout, viewPager);
        return view;
    }

    //数据刷新
    public void refresh() {
        /*
        TechnologyFragment technologyFragment = (TechnologyFragment) getChildFragmentManager().findFragmentByTag("TechnologyFragment");
        technologyFragment.refreshPosts();
        */
        Log.i(TAG,"Fuck!");
    }

    //加载适配器,显示页面
    private void setupViewPager(ViewPager viewPager) {
        top_fragList = new ArrayList<>();
        titleList = new ArrayList<>();

        top_fragList.add(new TechnologyFragment());
        top_fragList.add(new GameFragment());
        top_fragList.add(new MusicFragment());

        titleList.add("技术");
        titleList.add("游戏");
        titleList.add("音乐");
        TabPagerAdapter adapter = new TabPagerAdapter(getChildFragmentManager(), top_fragList, titleList);
        viewPager.setAdapter(adapter);
    }

    //加载Tab栏
    private void initTabLayout(SlidingTabLayout tabLayout, ViewPager viewPager) {
        tabLayout.setDistributeEvenly(true);
        tabLayout.setTabTitleTextSize(16);
        tabLayout.setTabStripWidth(150);
        tabLayout.setViewPager(viewPager);
    }
}
