package com.distributed.systems.foodies;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import java.io.IOException;

public class RegisterActivity extends AppCompatActivity {

    EditText usernameEditText, passwordEditText, contactEditText, cityEditText, emailEditText;
    Button registerButton;

    final String URL = "http://10.0.2.2/DistributedSystemsMiddleware/registeruser.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        usernameEditText = (EditText) findViewById(R.id.usernameEditText);
        passwordEditText = (EditText) findViewById(R.id.passwordEditText);
        contactEditText = (EditText) findViewById(R.id.contactEditText);
        cityEditText = (EditText) findViewById(R.id.cityEditText);
        emailEditText = (EditText) findViewById(R.id.emailEditText);

        registerButton = (Button) findViewById(R.id.registerButton);

        registerButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                new Thread(new Runnable() {
                    @Override
                    public void run() {
                        try {
                            registerUser();
                        } catch (IOException e) {
                            e.printStackTrace();
                        }
                    }
                }).start();
            }
        });
    }

    private void registerUser() throws IOException {
        String username = usernameEditText.getText().toString();
        String password = passwordEditText.getText().toString();
        String contactNo = contactEditText.getText().toString();
        String city = cityEditText.getText().toString();
        String email = emailEditText.getText().toString();

        String params = "username=" + username + "&password=" + password + "&contact_number=" + contactNo + "&city=" + city + "&email=" + email + "&user_type=client";

        final String isSuccess = Post.postWithParams(URL, params);

        runOnUiThread(new Runnable() {
            @Override
            public void run() {
                Toast.makeText(RegisterActivity.this, isSuccess, Toast.LENGTH_SHORT).show();
            }
        });


    }
}
