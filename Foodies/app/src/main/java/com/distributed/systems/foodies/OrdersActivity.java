package com.distributed.systems.foodies;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
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
import java.util.Iterator;

public class OrdersActivity extends AppCompatActivity {

    ListView ordersListView;
    ArrayList<String> descriptions;
    ArrayList<Integer> ids;
    ArrayList<Double> prices;
    ArrayList<String> names;
    String username, email;

    final String URL = "http://10.0.2.2/DistributedSystemsMiddleware/getproducts.php";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_orders);

        ordersListView = (ListView) findViewById(R.id.ordersListView);

        username = getIntent().getStringExtra("username");
        email = getIntent().getStringExtra("email");

        new Thread(new Runnable() {
            @Override
            public void run() {
                try {
                    getAllProducts();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }).start();

        ordersListView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                Intent intent = new Intent(getApplicationContext(), ProductDetailActivity.class);
                intent.putExtra("title", names.get(i));
                intent.putExtra("price", prices.get(i));
                intent.putExtra("description", descriptions.get(i));
                intent.putExtra("id", ids.get(i));
                intent.putExtra("username", username);
                intent.putExtra("email", email);
                startActivity(intent);
            }
        });

    }

    private JSONObject getAllProducts() throws IOException {
        final String productsString = Post.postWithParams(URL, "");

        try {
            JSONObject obj = new JSONObject(productsString);
            JSONArray obj1 = (JSONArray) obj.getJSONArray("orders");

            names = new ArrayList<String>();
            descriptions = new ArrayList<String>();
            ids = new ArrayList<Integer>();
            prices = new ArrayList<Double>();
            for (int i = 0; i < obj1.length(); i++) {
                String name = obj1.getJSONObject(i).getString("product_name");
                String description = obj1.getJSONObject(i).getString("description");
                double price = Double.valueOf(obj1.getJSONObject(i).getString("price"));
                int id = Integer.valueOf(obj1.getJSONObject(i).getString("id"));
                names.add(name);
                prices.add(price);
                descriptions.add(description);
                ids.add(id);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }

        runOnUiThread(new Runnable() {
            @Override
            public void run() {
                Toast.makeText(OrdersActivity.this, productsString, Toast.LENGTH_SHORT).show();
                ArrayAdapter adapter = new ArrayAdapter(getApplicationContext(), android.R.layout.simple_list_item_1, names);
                ordersListView.setAdapter(adapter);
            }
        });

        return null;
    }
}
