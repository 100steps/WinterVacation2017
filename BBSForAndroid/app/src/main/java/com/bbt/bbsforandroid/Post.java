package com.bbt.bbsforandroid;

/**
 * 帖子实体类
 * Created by zyt on 2018/1/11.
 */

public class Post {

    private String user_name;
    private String title;
    private int comment_number;
    private int user_imageId;

    public Post(String user_name,String title,int user_imageId,int comment_number){
        this.user_name = user_name;
        this.title = title;
        this.user_imageId = user_imageId;
        this.comment_number = comment_number;
    }

    public String getUser_name(){
        return user_name;
    }

    public String getTitle(){
        return title;
    }

    public int getUser_imageId(){
        return user_imageId;
    }

    public int getComment_number(){
        return comment_number;
    }
}
