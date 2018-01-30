package com.bbt.bbsforandroid.Adapter;


import android.content.Context;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;

import com.bbt.bbsforandroid.Post;
import com.bbt.bbsforandroid.R;
import com.bumptech.glide.Glide;

import java.util.List;

/**
 * Post适配器
 * 用到CardView和RecyclerView
 * Created by zyt on 2018/1/11.
 */

public class PostAdapter extends RecyclerView.Adapter<PostAdapter.ViewHolder> {

    private Context mContext;
    private List<Post> mPostList;

    //构造函数中实例化item中控件
    static class ViewHolder extends RecyclerView.ViewHolder {

        CardView cardView;
        ImageView user_image;
        ImageButton comment;
        TextView user_name;
        TextView comment_number;
        TextView title;

        ViewHolder(View itemView) {
            super(itemView);
            cardView = (CardView) itemView;
            user_image = (ImageView) itemView.findViewById(R.id.user_image);
            comment_number = (TextView) itemView.findViewById(R.id.post_comment_num);
            title = (TextView) itemView.findViewById(R.id.post_title);
            user_name = (TextView) itemView.findViewById(R.id.user_name);
            comment = (ImageButton) itemView.findViewById(R.id.post_comment);
        }
    }

    //初始化postList数据
    public PostAdapter(List<Post> postList) {
        mPostList = postList;
    }

    //加载布局实例、设置监听器并返回
    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        if (mContext == null) {
            mContext = parent.getContext();
        }
        View view = LayoutInflater.from(mContext).inflate(R.layout.post_item, parent, false);
        final ViewHolder holder = new ViewHolder(view);
        /*
        holder.cardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //父布局点击触发事件
                //进入详细帖子页面
            }
        });
        holder.comment.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //点击评论按钮触发事件
                //评论数+1
                int temp = Integer.parseInt(holder.comment_number.getText().toString()) + 1;
                holder.comment_number.setText(temp);
                Toast.makeText(mContext,temp,Toast.LENGTH_SHORT).show();
            }
        });
        */
        return holder;
    }

    //item子项控件初始化
    @Override
    public void onBindViewHolder(ViewHolder holder, int position) {
        Post post = mPostList.get(position);
        holder.title.setText(post.getTitle());
        holder.user_name.setText(post.getUser_name());
        holder.comment_number.setText(Integer.toString(post.getComment_number()));
        Glide.with(mContext).load(post.getUser_imageId()).into(holder.user_image);
    }

    @Override
    public int getItemCount() {
        return mPostList.size();
    }
}
