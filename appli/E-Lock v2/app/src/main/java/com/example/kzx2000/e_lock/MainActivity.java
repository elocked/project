package com.example.kzx2000.e_lock;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import java.util.HashMap;
import android.widget.TextView;

import com.example.kzx2000.e_lock.helper.SQLiteHandler;
import com.example.kzx2000.e_lock.helper.SessionManager;


public class MainActivity extends Activity {

    private TextView txtFirstName;
    private TextView txtLastName;
    private TextView txtEmail;
    private Button btnLogout;
    private Button btnMaps;

    private SQLiteHandler db;
    private SessionManager session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        txtFirstName = (TextView) findViewById(R.id.firstName);
        txtLastName = (TextView) findViewById(R.id.lastName);
        txtEmail = (TextView) findViewById(R.id.email);
        btnLogout = (Button) findViewById(R.id.btnLogout);
        btnMaps = (Button) findViewById(R.id.btnMaps);

        // SqLite database handler
        db = new SQLiteHandler(getApplicationContext());

        // session manager
        session = new SessionManager(getApplicationContext());

        if (!session.isLoggedIn()) {
            logoutUser();
        }

        // Fetching user details from sqlite
        HashMap<String, String> user = db.getUserDetails();

        String firstName = user.get("firstName");
        String lastName = user.get("lastName");
        String email = user.get("email");

        // Displaying the user details on the screen
        txtFirstName.setText(firstName);
        txtLastName.setText(lastName);
        txtEmail.setText(email);

        // Maps button click event
        btnMaps.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Launching the login activity
                Intent intent = new Intent(MainActivity.this, MapsActivity.class);
                startActivity(intent);
                finish();
            }
        });

        // Logout button click event
        btnLogout.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                logoutUser();
            }
        });
    }

    /**
     * Logging out the user. Will set isLoggedIn flag to false in shared
     * preferences Clears the user data from sqlite users table
     * */
    private void logoutUser() {
        session.setLogin(false);

        db.deleteUsers();

        // Launching the login activity
        Intent intent = new Intent(MainActivity.this, LoginActivity.class);
        startActivity(intent);
        finish();
    }
}