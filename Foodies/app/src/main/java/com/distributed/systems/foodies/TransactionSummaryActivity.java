package com.distributed.systems.foodies;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;

public class TransactionSummaryActivity extends AppCompatActivity {

    TextView orderIdTextView, orderStatusTextView, orderProductNameTextView, orderPriceTextView;

    final String URL = "http://10.0.2.2/DistributedSystemsMiddleware/getproductbyid.php";

    String address, city, status;
    int id, quantity, productId;
    double price;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_transaction_summary);

        id = getIntent().getIntExtra("id", 0);
        address = getIntent().getStringExtra("address");
        status = getIntent().getStringExtra("status");
        city = getIntent().getStringExtra("city");
        quantity = getIntent().getIntExtra("quantity", 0);
        productId = getIntent().getIntExtra("productId", 0);
        price = getIntent().getDoubleExtra("price", 0);

        orderIdTextView = (TextView) findViewById(R.id.orderIdTextView);
        orderStatusTextView = (TextView) findViewById(R.id.orderStatusTextView);
        orderProductNameTextView = (TextView) findViewById(R.id.orderProductNameTextView);
        orderPriceTextView = (TextView) findViewById(R.id.orderPriceTextView);

        orderIdTextView.setText(String.valueOf(id));
        orderStatusTextView.setText(status);
        orderPriceTextView.setText(String.valueOf(price));

        new Thread(new Runnable() {
            @Override
            public void run() {
                try {
                    getProductName();
                } catch (IOException e) {
                    e.printStackTrace();
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }).start();
    }

    private void getProductName() throws IOException, JSONException {
        String params = "id=" + productId;
        final String productsString = Post.postWithParams(URL, params);

        JSONObject obj = new JSONObject(productsString);
        String name = obj.getString("product_name");

        orderProductNameTextView.setText(name + " (x" + quantity + ")");

    }
}
