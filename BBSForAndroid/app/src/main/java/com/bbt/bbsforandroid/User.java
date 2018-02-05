package com.bbt.bbsforandroid;

/*
 * User信息实体类
 * Created by zyt on 2018/1/27.
 */

public class User {

    private String user_name;
    private String user_gender;
    private String user_email;
    private String user_password;

    public User(String user_name, String user_gender, String user_email, String user_password) {
        this.user_name = user_name;
        this.user_gender = user_gender;
        this.user_email = user_email;
        this.user_password = user_password;
    }

    public String getUser_name() {
        return user_name;
    }

    public String getUser_gender() {
        return user_gender;
    }

    public String getUser_email() {
        return user_email;
    }

    public String getUser_password() {
        return user_password;
    }
}
