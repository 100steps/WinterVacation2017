package com.bbt.bbsforandroid.Adapter;

import android.app.Fragment;
import android.app.FragmentManager;
import android.support.v13.app.FragmentPagerAdapter;

import java.util.List;

/**
 * TAB页面切换适配器
 * PS:适配包的不同是因为考虑到碎片间的嵌套，以及viewPager的使用bug
 * 决定向上兼容，最低兼容v13版本，也就是安卓3.2版本，最低sdk版本也随之改动为17
 * Created by zyt on 2018/1/7.
 */

public class TabPagerAdapter extends FragmentPagerAdapter {

    private List<Fragment> fragList;
    private List<String> titleList;

    public TabPagerAdapter(FragmentManager fragmentManager, List<Fragment> fragList, List<String> titleList) {
        super(fragmentManager);
        this.fragList = fragList;
        this.titleList = titleList;
    }
    public TabPagerAdapter(FragmentManager fragmentManager,List<Fragment> fragList){
        this(fragmentManager,fragList,null);
    }

    @Override
    public Fragment getItem(int position) {
        return fragList.get(position);
    }

    @Override
    public int getCount() {
        return fragList.size();
    }

    @Override
    public CharSequence getPageTitle(int position) {
        return titleList.get(position);
    }

}
