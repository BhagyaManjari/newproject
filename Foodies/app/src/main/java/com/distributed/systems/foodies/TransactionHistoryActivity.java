package com.distributed.systems.foodies;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;

public class TransactionHistoryActivity extends AppCompatActivity {

    ListView transactionsListView;

    ArrayList<String>  addresses, cities, status;
    ArrayList<Integer> quantities, productIds, ids;
    ArrayList<Double> prices;
    ArrayList<String> listDisplay;
    String username;
    final String URL = "http://10.0.2.2/DistributedSystemsMiddleware/getorders.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_transaction_history);

        username = getIntent().getStringExtra("username");

        transactionsListView = (ListView) findViewById(R.id.transactionsListView);

        new Thread(new Runnable() {
            @Override
            public void run() {
                try {
                    getOrders();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }).start();

        transactionsListView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                Intent intent = new Intent(getApplicationContext(), TransactionSummaryActivity.class);
                intent.putExtra("id", ids.get(i));
                intent.putExtra("address", addresses.get(i));
                intent.putExtra("city", cities.get(i));
                intent.putExtra("quantity", quantities.get(i));
                intent.putExtra("productId", productIds.get(i));
                intent.putExtra("status", status.get(i));
                intent.putExtra("price", prices.get(i));
                startActivity(intent);
            }
        });
    }

    private void getOrders() throws IOException {
        final String ordersString = Post.postWithParams(URL, "username=" + username);

        try {
            JSONObject obj = new JSONObject(ordersString);
            JSONArray obj1 = (JSONArray) obj.getJSONArray("orders");

            ids = new ArrayList<Integer>();
            addresses = new ArrayList<String>();
            listDisplay = new ArrayList<String>();
            cities = new ArrayList<String>();
            status = new ArrayList<String>();
            quantities = new ArrayList<Integer>();
            productIds = new ArrayList<Integer>();
            prices = new ArrayList<Double>();
            for (int i = 0; i < obj1.length(); i++) {
                int id = Integer.valueOf(obj1.getJSONObject(i).getString("id"));
                int productId = Integer.valueOf(obj1.getJSONObject(i).getString("product_id"));
                String address = obj1.getJSONObject(i).getString("address");
                String city = obj1.getJSONObject(i).getString("city");
                String confirm_status = obj1.getJSONObject(i).getString("confirm_status");
                double price = Double.valueOf(obj1.getJSONObject(i).getString("total_price"));
                int quantity = Integer.valueOf(obj1.getJSONObject(i).getString("quantity"));

                ids.add(id);
                productIds.add(productId);
                addresses.add(address);
                cities.add(city);
                status.add(confirm_status);
                prices.add(price);
                quantities.add(quantity);

                listDisplay.add("Order: " + id + " (x" + quantity + ")" + status);
            }

            runOnUiThread(new Runnable() {
                @Override
                public void run() {
                    Toast.makeText(TransactionHistoryActivity.this, ordersString, Toast.LENGTH_SHORT).show();
                    ArrayAdapter adapter = new ArrayAdapter(getApplicationContext(), android.R.layout.simple_list_item_1, listDisplay);
                    transactionsListView.setAdapter(adapter);
                }
            });
        } catch (JSONException e) {
            e.printStackTrace();
        }


    }
}
