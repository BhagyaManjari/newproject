package com.distributed.systems.foodies;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import java.io.IOException;

public class CompleteOrderActivity extends AppCompatActivity {

    EditText addressEditText, cityEditText, quantityEditText;

    TextView totalPriceTextView;

    Button completeOrderButton;

    String total;

    final String URL = "http://10.0.2.2/DistributedSystemsMiddleware/createorder.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_complete_order);

        final String username = getIntent().getStringExtra("username");
        final String email = getIntent().getStringExtra("email");
        final int id = getIntent().getIntExtra("id", 0);
        final double price = getIntent().getDoubleExtra("price", 0);

        addressEditText = (EditText) findViewById(R.id.addressEditText);
        cityEditText = (EditText) findViewById(R.id.cityEditText);
        quantityEditText = (EditText) findViewById(R.id.quantityEditText);

        totalPriceTextView = (TextView) findViewById(R.id.totalPriceTextView);

        completeOrderButton = (Button) findViewById(R.id.completeOrderButton);

        quantityEditText.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence charSequence, int i, int i1, int i2) {

            }

            @Override
            public void onTextChanged(CharSequence charSequence, int i, int i1, int i2) {

            }

            @Override
            public void afterTextChanged(Editable editable) {
                if (!editable.toString().equals("")) {
                    total = String.valueOf(price * Integer.valueOf(editable.toString()));
                    totalPriceTextView.setText(total);
                }
            }
        });

        completeOrderButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String address = addressEditText.getText().toString();
                String city = cityEditText.getText().toString();
                String quantity = quantityEditText.getText().toString();

                Toast.makeText(CompleteOrderActivity.this, email, Toast.LENGTH_SHORT).show();

                final String params = "address=" + address + "&city=" + city + "&quantity=" + quantity + "&total_price=" + total + "&confirm_status=confirmed&buyer_username=" + username + "&product_id=" + id +"&email=" +email;

                new Thread(
                        new Runnable() {
                            @Override
                            public void run() {
                                try {
                                    Post.postWithParams(URL, params);
                                } catch (IOException e) {
                                    e.printStackTrace();
                                }
                            }
                        }
                ).start();
            }
        });
    }
}
