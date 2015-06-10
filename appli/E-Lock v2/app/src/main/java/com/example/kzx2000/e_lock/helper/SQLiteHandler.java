package com.example.kzx2000.e_lock.helper;

import java.util.HashMap;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

public class SQLiteHandler extends SQLiteOpenHelper {

	private static final String TAG = SQLiteHandler.class.getSimpleName();

	// All Static variables
	// Database Version
	private static final int DATABASE_VERSION = 1;

	// Database Name
	private static final String DATABASE_NAME = "sqLite_database_android_api";

	// Login table name
	private static final String TABLE_LOGIN = "login";

	// Login Table Columns names
	private static final String KEY_ID = "id";
	private static final String KEY_FIRSTNAME = "firstName";
	private static final String KEY_LASTNAME = "lastName";
	private static final String KEY_EMAIL = "email";
	private static final String KEY_PHONENUMBER = "phoneNumber";
	private static final String KEY_CREDITCARDNUMBER = "creditCardNumber";
	private static final String KEY_CREATED_AT = "created_at";
	private static final String KEY_RATE = "rate";

	public SQLiteHandler(Context context) {
		super(context, DATABASE_NAME, null, DATABASE_VERSION);
	}

	// Creating Tables
	@Override
	public void onCreate(SQLiteDatabase db) {
		String CREATE_LOGIN_TABLE = "CREATE TABLE " + TABLE_LOGIN + "("
				+ KEY_ID + " INTEGER PRIMARY KEY," + KEY_FIRSTNAME + " TEXT,"
				+ KEY_LASTNAME + " TEXT," + KEY_PHONENUMBER + " TEXT,"
				+ KEY_CREDITCARDNUMBER + " TEXT," + KEY_EMAIL + " TEXT UNIQUE,"
				+ KEY_RATE + " INT," + KEY_CREATED_AT + " TEXT" + ")";
		db.execSQL(CREATE_LOGIN_TABLE);

		Log.d(TAG, "Database tables created");
	}

	// Upgrading database
	@Override
	public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
		// Drop older table if existed
		db.execSQL("DROP TABLE IF EXISTS " + TABLE_LOGIN);

		// Create tables again
		onCreate(db);
	}

	/**
	 * Storing user details in database
	 * */
	public void addUser(String firstName, String lastName, String email, String phoneNumber, String creditCardNumber, String created_at) {
		SQLiteDatabase db = this.getWritableDatabase();
		Log.d(TAG, "first name - addUser" + firstName);
		ContentValues values = new ContentValues();
		values.put(KEY_FIRSTNAME, firstName); // First Name
		values.put(KEY_LASTNAME, lastName);
		values.put(KEY_EMAIL, email); // Email
		values.put(KEY_PHONENUMBER, phoneNumber);
		values.put(KEY_CREDITCARDNUMBER, creditCardNumber);
		values.put(KEY_RATE, "NULL");
		values.put(KEY_CREATED_AT, created_at); // Created At

		// Inserting Row
		long id = db.insert(TABLE_LOGIN, null, values);
		db.close(); // Closing database connection

		Log.d(TAG, "New user inserted into sqlite: " + id);
	}

	/**
	 * Getting user data from database
	 * */
	public HashMap<String, String> getUserDetails() {
		HashMap<String, String> user = new HashMap<String, String>();
		String selectQuery = "SELECT  * FROM " + TABLE_LOGIN;

		SQLiteDatabase db = this.getReadableDatabase();
		Cursor cursor = db.rawQuery(selectQuery, null);
		// Move to first row
		cursor.moveToFirst();
		Log.d(TAG, "Nb :"+cursor.getCount());
		if (cursor.getCount() > 0) {
			Log.d(TAG, "First Name: "+ cursor.getString(1));
			user.put("firstName", cursor.getString(1));
			user.put("lastName", cursor.getString(2));
			user.put("phoneNumber", cursor.getString(3));
			user.put("creditCardNumber", cursor.getString(4));
			user.put("email", cursor.getString(5));
			user.put("rate", cursor.getString(6));
			user.put("created_at", cursor.getString(7));
		}
		cursor.close();
		db.close();
		// return user
		Log.d(TAG, "Fetching user from Sqlite: " + user.toString());

		return user;
	}

	/**
	 * Getting user login status return true if rows are there in table
	 * */
	public int getRowCount() {
		String countQuery = "SELECT  * FROM " + TABLE_LOGIN;
		SQLiteDatabase db = this.getReadableDatabase();
		Cursor cursor = db.rawQuery(countQuery, null);
		int rowCount = cursor.getCount();
		db.close();
		cursor.close();

		// return row count
		return rowCount;
	}

	/**
	 * Re crate database Delete all tables and create them again
	 * */
	public void deleteUsers() {
		SQLiteDatabase db = this.getWritableDatabase();
		// Delete All Rows
		db.delete(TABLE_LOGIN, null, null);
		db.close();

		Log.d(TAG, "Deleted all user info from sqlite");
	}

}
