package com.distributed.systems.foodies;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;

public class LoginActivity extends AppCompatActivity {

    EditText usernameEditText, passwordEditText;
    Button loginButton, goToRegisterButton;

    final String URL = "http://10.0.2.2/DistributedSystemsMiddleware/loginuser.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        usernameEditText = (EditText) findViewById(R.id.usernameEditText);
        passwordEditText = (EditText) findViewById(R.id.passwordEditText);

        loginButton = (Button) findViewById(R.id.loginButton);
        goToRegisterButton = (Button) findViewById(R.id.goToRegisterButton);

        goToRegisterButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                startActivity(new Intent(getApplicationContext(), RegisterActivity.class));
            }
        });

        loginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                new Thread(new Runnable() {
                    @Override
                    public void run() {
                        try {
                            loginUser();
                        } catch (IOException e) {
                            e.printStackTrace();
                        }
                    }
                }).start();
            }
        });

    }

    private void loginUser() throws IOException {

        String username = usernameEditText.getText().toString();
        String password = passwordEditText.getText().toString();

        String params = "username=" + username + "&password=" + password;

        final String user = Post.postWithParams(URL, params);

        runOnUiThread(new Runnable() {
            @Override
            public void run() {
                Toast.makeText(LoginActivity.this, user, Toast.LENGTH_SHORT).show();
                if (!user.equals("")) {

                    String username = "";
                    String email = "";
                    try {
                        JSONObject userObj = new JSONObject(user);
                        username = userObj.getString("username");
                        email = userObj.getString("email");
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }

                    Intent intent = new Intent(getApplicationContext(), MainActivity.class);
                    intent.putExtra("username", username);
                    intent.putExtra("email", email);
                    startActivity(intent);
                }
            }
        });

    }
}
