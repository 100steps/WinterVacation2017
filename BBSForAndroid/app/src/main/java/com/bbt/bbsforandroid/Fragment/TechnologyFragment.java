package com.bbt.bbsforandroid.Fragment;

import android.os.Bundle;
import android.app.Fragment;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.ashokvarma.bottomnavigation.BottomNavigationBar;
import com.ashokvarma.bottomnavigation.ShapeBadgeItem;
import com.bbt.bbsforandroid.Activity.StartActivity;
import com.bbt.bbsforandroid.Adapter.PostAdapter;
import com.bbt.bbsforandroid.Post;
import com.bbt.bbsforandroid.R;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

/**
 * 技术板块帖子
 * Created by zyt on 2018/1/9.
 */

public class TechnologyFragment extends Fragment {

    public static final String TAG = "TechnologyFragment";
    private View view;
    private PostAdapter adapter;
    private List<Post> postList;
    private SwipeRefreshLayout swipeRefreshLayout;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        view = inflater.inflate(R.layout.fragment_technology, container, false);
        RecyclerView recyclerView;
        LinearLayoutManager linearLayoutManager;
        postList = new ArrayList<>();
        recyclerView = (RecyclerView) view.findViewById(R.id.technology_recycleView);
        linearLayoutManager = new LinearLayoutManager(view.getContext(),LinearLayoutManager.VERTICAL,false);

        //下拉刷新
        swipeRefreshLayout = (SwipeRefreshLayout) view.findViewById(R.id.swipe_refresh);
        swipeRefreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                //网络请求数据，并刷新
                refreshPosts();
            }
        });

        recyclerView.setLayoutManager(linearLayoutManager);
        Post[] posts;
        posts = new Post[]{new Post("Rainbow", "this is a title.", R.drawable.ic_star, 1),
                new Post("Rain", "this is another title.", R.drawable.ic_home_black_24dp, 2),
                new Post("Rain1", "this is another title.", R.drawable.ic_home_black_24dp, 2),
                new Post("Rain2", "this is another title.", R.drawable.ic_home_black_24dp, 2),
                new Post("Rain3", "this is another title.", R.drawable.ic_home_black_24dp, 2),
                new Post("Rain4", "this is another title.", R.drawable.ic_home_black_24dp, 2),
                new Post("Rain5", "this is another title.", R.drawable.ic_home_black_24dp, 2)};

        //遍历添加，新方法
        postList.addAll(Arrays.asList(posts));

        addItem(new Post("Test", "this is a test", R.mipmap.icon, 666));

        adapter = new PostAdapter(postList);
        recyclerView.setAdapter(adapter);

        //获取父Fragment关联的Activity，并找到其中声明的控件和变量
        final StartActivity startActivity = (StartActivity) this.getParentFragment().getActivity();
        //底部导航栏
        final BottomNavigationBar bottomNavigationBar = startActivity.findViewById(R.id.bottom_navigation);
        //三个选择项目
        final List<ShapeBadgeItem> badgeItemList = startActivity.getBadgeItemList();
        //badgeItemList.get(0).show(true);

        recyclerView.addOnScrollListener(new RecyclerView.OnScrollListener() {
            @Override
            public void onScrolled(RecyclerView recyclerView, int dx, int dy) {
                super.onScrolled(recyclerView, dx, dy);
                //RecyclerView滚动监听，下拉隐藏BottomBar，上拉显示出来
                if (dy > 0) {
                    bottomNavigationBar.hide(true);
                }
                if (dy < 0) {
                    bottomNavigationBar.show(true);
                }
            }

            @Override
            public void onScrollStateChanged(RecyclerView recyclerView, int newState) {
                super.onScrollStateChanged(recyclerView, newState);
            }
        });
        return view;
    }

    //将新帖子添加到RecyclerView中
    private void addItem(Post post) {
        postList.add(0, post);
    }

    public void refreshPosts() {
        swipeRefreshLayout.postDelayed(new Runnable() {
            @Override
            public void run() {
                swipeRefreshLayout.setRefreshing(false);
            }
        }, 3000);
    }

    @Override
    public void onActivityCreated(Bundle savedInstanceState) {
        super.onActivityCreated(savedInstanceState);

    }
}
