package com.bbt.bbsforandroid.Activity;

import android.app.FragmentManager;
import android.app.FragmentTransaction;
import android.content.Intent;
import android.app.Fragment;
import android.support.v4.view.ViewPager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;

import com.ashokvarma.bottomnavigation.BottomNavigationBar;
import com.ashokvarma.bottomnavigation.BottomNavigationItem;
import com.ashokvarma.bottomnavigation.ShapeBadgeItem;
import com.bbt.bbsforandroid.Adapter.TabPagerAdapter;

import com.bbt.bbsforandroid.Fragment.MessageFragment;
import com.bbt.bbsforandroid.Fragment.MineFragment;
import com.bbt.bbsforandroid.Fragment.PostFragment;
import com.bbt.bbsforandroid.R;
import com.bbt.bbsforandroid.View.NoScrollViewPager;

import java.util.ArrayList;
import java.util.List;

/**
 * 主Activity，启动界面
 * 暂未设置BadgeItem
 * Created by zyt on 2018/1/4.
 */

public class StartActivity extends AppCompatActivity {

    private static final String PostFragment_TAG = "PostFragment";
    private static final String MessageFragment_TAG = "MessageFragment";
    private static final String MineFragment_TAG = "MineFragment";
    private static final String TAG = "StartActivity";
    private NoScrollViewPager bottom_viewPager;
    private BottomNavigationBar bottomNavigationBar;
    private List<ShapeBadgeItem> badgeItemList = new ArrayList<>();;
    private List<BottomNavigationItem> itemList;
    private PostFragment postFragment;
    private MessageFragment messageFragment;
    private MineFragment mineFragment;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_start);
        Log.i(TAG,"StartActivity --> onCreate");

        //加载toolbar，并设置标题
        final Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        toolbar.setTitle("BBS");
        setSupportActionBar(toolbar);

        bottom_viewPager = (NoScrollViewPager) findViewById(R.id.bottom_viewpager);
        bottomNavigationBar = (BottomNavigationBar) findViewById(R.id.bottom_navigation);

        setupViewPager(bottom_viewPager);
        //初始化子fragment
        initChildFragment();
        //底部导航栏初始化

        itemList = new ArrayList<>();
        //initBadgeItem();
        initBottomNavigationBar();

        bottomNavigationBar.setTabSelectedListener(new BottomNavigationBar.OnTabSelectedListener() {
            @Override
            public void onTabSelected(int position) {
                bottom_viewPager.setCurrentItem(position);
            }

            @Override
            public void onTabUnselected(int position) {

            }

            //多次选中一项消除小红点，并进行网络刷新工作
            @Override
            public void onTabReselected(int position) {

                postFragment.refresh();

                //badgeItemList.get(position).hide();

            }
        });

    }

    //Toolbar菜单及监听
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.toolbar_menu, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.toolbar_add:
                Intent intent = new Intent().setClass(this, NewPostActivity.class);
                startActivity(intent);
                break;
            default:
        }
        return true;
    }

    //加载适配器,显示页面
    private void setupViewPager(ViewPager viewPager) {
        List<Fragment> bottom_fragList = new ArrayList<>();
        bottom_fragList.add(new PostFragment());
        bottom_fragList.add(new MessageFragment());
        bottom_fragList.add(new MineFragment());
        TabPagerAdapter adapter = new TabPagerAdapter(getFragmentManager(), bottom_fragList);
        viewPager.setAdapter(adapter);
    }

    private void initBottomNavigationBar() {
        //暂未设置badgeItem
        itemList.add(new BottomNavigationItem(R.drawable.ic_home, "帖子"));
        itemList.add(new BottomNavigationItem(R.drawable.ic_message, "消息"));
        itemList.add(new BottomNavigationItem(R.drawable.ic_mine, "我"));

        //如果接收到新消息,设置该tab项的未读小红点
        bottomNavigationBar.setMode(BottomNavigationBar.MODE_FIXED);
        bottomNavigationBar.setBackgroundStyle(BottomNavigationBar.BACKGROUND_STYLE_STATIC);
        bottomNavigationBar.setFirstSelectedPosition(0)
                .addItem(itemList.get(0))
                .addItem(itemList.get(1))
                .addItem(itemList.get(2))
                .initialise();
    }
/*
    private void initBadgeItem() {

        //未读消息红点，定义时并不会复制对象，绝望，强行复制粘贴的我很无奈...
        final ShapeBadgeItem badgeItem0 = new ShapeBadgeItem()
                .setShape(ShapeBadgeItem.SHAPE_OVAL)
                .setSizeInDp(this, 8, 8)
                .setEdgeMarginInDp(this, 5);
        final ShapeBadgeItem badgeItem1 = new ShapeBadgeItem()
                .setShape(ShapeBadgeItem.SHAPE_OVAL)
                .setSizeInDp(this, 8, 8)
                .setEdgeMarginInDp(this, 5);
        final ShapeBadgeItem badgeItem2 = new ShapeBadgeItem()
                .setShape(ShapeBadgeItem.SHAPE_OVAL)
                .setSizeInDp(this,8,8)
                .setEdgeMarginInDp(this,5);


        badgeItemList.add(badgeItem0);
        badgeItemList.add(badgeItem1);
        badgeItemList.add(badgeItem2);
        for(int i = 0;i < 3 ;i++){
            if (!badgeItemList.get(i).isHidden()){
                badgeItemList.get(i).hide();
            }
        }

    }
*/

    //初始化子Fragment
    private void initChildFragment() {
        postFragment = new PostFragment();
        messageFragment = new MessageFragment();
        mineFragment = new MineFragment();
        addFragment(postFragment, PostFragment_TAG);
        addFragment(messageFragment, MessageFragment_TAG);
        addFragment(mineFragment, MineFragment_TAG);
    }

    //获取Fragment实例
    private void addFragment(Fragment fragment, String tag) {
        FragmentManager fragmentManager = getFragmentManager();
        FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
        fragmentTransaction.add(fragment, tag);
        fragmentTransaction.commit();
    }

    public List<ShapeBadgeItem> getBadgeItemList() {
        return badgeItemList;
    }
}
