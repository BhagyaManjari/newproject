package com.distributed.systems.foodies;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class ProductDetailActivity extends AppCompatActivity {

    TextView title, priceText, descriptionText;
    Button buyButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_product_detail);

        title = (TextView) findViewById(R.id.title);
        priceText = (TextView) findViewById(R.id.price);
        descriptionText = (TextView) findViewById(R.id.description);

        buyButton = (Button) findViewById(R.id.buyButton);

        String name = getIntent().getStringExtra("title");
        final String email = getIntent().getStringExtra("email");
        final String username = getIntent().getStringExtra("username");
        final double price = getIntent().getDoubleExtra("price", 0);
        String description = getIntent().getStringExtra("description");
        final int id = getIntent().getIntExtra("id", 0);

        title.setText(name);
        priceText.setText(String.valueOf(price));
        descriptionText.setText(description);

        buyButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getApplicationContext(), CompleteOrderActivity.class);
                intent.putExtra("id", id);
                intent.putExtra("username", username);
                intent.putExtra("price", price);
                intent.putExtra("email", email);
                startActivity(intent);
            }
        });
    }
}
