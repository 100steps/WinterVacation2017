package com.bbt.bbsforandroid.Utils;

import android.util.Log;

import com.bbt.bbsforandroid.User;
import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import java.util.List;

import okhttp3.Callback;
import okhttp3.FormBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;

/**
 * 网络操作工具类
 * Created by zyt on 2018/2/4.
 */

public class HTTPUtil {

    /**
     * 发送get请求
     * @param address  url
     * @param callback 回调接口
     */
    public static void sendGetRequest(String address, Callback callback) {
        OkHttpClient client = new OkHttpClient();
        Request request = new Request.Builder()
                .url(address)
                .build();
        client.newCall(request).enqueue(callback);
    }

    /*
     * 注册请求
     */
    public static void sendSignUpRequest(String address, String user_name, String user_password, Callback callback) {

        OkHttpClient client = new OkHttpClient();
        RequestBody requestBody = new FormBody.Builder()
                .add("user_name", user_name)
                .add("user_password", user_password)
                .build();
        Request request = new Request.Builder()
                .url(address)
                .post(requestBody)
                .build();
        client.newCall(request).enqueue(callback);
    }

    /**
     * 采用Gson解析方式
     * @param jsonData json数据
     */

    public static void parseJSON(String jsonData) {

        Gson gson = new Gson();
        List<User> userList =
                gson.fromJson(jsonData, new TypeToken<List<User>>() {}.getType());
        for (User user : userList) {
            Log.i("user_name", user.getUser_name());
            Log.i("user_gender", user.getUser_gender());
        }
    }


}
