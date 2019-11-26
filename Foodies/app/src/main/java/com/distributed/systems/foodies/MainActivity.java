package com.distributed.systems.foodies;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity {

    Button orderButton, transactionButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        orderButton = (Button) findViewById(R.id.orderButton);
        transactionButton = (Button) findViewById(R.id.transactionButton);

        final String username = getIntent().getStringExtra("username");
        final String email = getIntent().getStringExtra("email");

        orderButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getApplicationContext(), OrdersActivity.class);
                intent.putExtra("username", username);
                intent.putExtra("email", email);
                startActivity(intent);
            }
        });

        transactionButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getApplicationContext(), TransactionHistoryActivity.class);
                intent.putExtra("username", username);
                startActivity(intent);
            }
        });
    }
}
