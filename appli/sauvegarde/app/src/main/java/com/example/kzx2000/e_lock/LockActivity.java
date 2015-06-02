package com.example.kzx2000.e_lock;


import java.io.IOException;
import java.math.BigInteger;
import java.util.Arrays;
import java.util.concurrent.ExecutionException;

import android.content.Context;
import android.media.MediaPlayer;
import android.nfc.NfcAdapter;
import android.nfc.Tag;
import android.nfc.tech.NfcV;
import android.os.AsyncTask;
import android.os.Bundle;
import android.app.Activity;
import android.app.PendingIntent;
import android.content.Intent;
import android.content.IntentFilter;
import android.os.Vibrator;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

public class LockActivity extends Activity {
    private Tag tag;
    private NfcAdapter nfcAdapter;
    private TextView textView;
    private MediaPlayer mPlayer = null;
    private Button btn_open;
    private Button btn_close;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_lock);

        textView = (TextView)findViewById(R.id.textViewID);
        btn_open = (Button) findViewById(R.id.btn_open);
        btn_close = (Button) findViewById(R.id.btn_close);
        nfcAdapter = NfcAdapter.getDefaultAdapter(this);
        NFCState();



        handleIntent(getIntent());
    }
    private synchronized void openLock(Tag tag){
                new NfcVOpenTagTask().execute(tag);

    }
    private synchronized void closeLock(Tag tag){
                new NfcVCloseTagTask().execute(tag);

    }

    private void NFCState(){
        //Detecte etat du NFC
        if(nfcAdapter==null){
            textView.setText("NFC is not available on your phone!");
        }
        else if (!nfcAdapter.isEnabled()) {
            textView.setText("NFC is disable");
            startActivity(new Intent(android.provider.Settings.ACTION_NFC_SETTINGS));
        }
        else{
            textView.setText("NFC is enable");
        }
    }
    @Override
    public void onResume() {
        super.onResume();
        setupForegroundDispatch(this, nfcAdapter);
    }
    @Override
    public void onPause() {
        stopForegroundDispatch(this, nfcAdapter);
        if(mPlayer != null) {
            mPlayer.stop();
            mPlayer.release();
        }
        super.onPause();
    }

    @Override
    protected void onNewIntent(Intent intent) {
        handleIntent(intent);
    }

    private void handleIntent(Intent intent){
        if (NfcAdapter.ACTION_TAG_DISCOVERED.equals(intent.getAction())) {
            textView.setText("Tag Detected");
            Vibrator v = (Vibrator) getSystemService(Context.VIBRATOR_SERVICE);
            v.vibrate(1000);
            tag = intent.getParcelableExtra(NfcAdapter.EXTRA_TAG);
            Log.d("Action", "ACTION_TAG_DISCOVERED");
            Log.d("Tag", tag.toString());
            String[] techList = tag.getTechList();
            String searchedTech = NfcV.class.getName();
            for (String tech : techList) {
                if (searchedTech.equals(tech)) {
                    Log.d("Tech", tech);
                    new NfcVReaderIDTask().execute(tag);
                    new NfcVReaderBlockTask().execute(tag);
                    btn_open.setOnClickListener(new View.OnClickListener() {
                        public void onClick(View v) {
                            openLock(tag);
                        }
                    });
                    btn_close.setOnClickListener(new View.OnClickListener() {
                        public void onClick(View v) {
                            closeLock(tag);
                        }
                    });
                    break;
                }
            }
        }
    }

    /**
     *
     * @param activity	The {Activity} requesting foreground dispatch.
     * @param adapter	The {NfcAdapter} used for the foreground dispatch.
     */
    public static void setupForegroundDispatch(final Activity activity, NfcAdapter adapter) {
        final Intent intent = new Intent(activity.getApplicationContext(), activity.getClass());
        intent.setFlags(Intent.FLAG_ACTIVITY_SINGLE_TOP);

        final PendingIntent pendingIntent = PendingIntent.getActivity(activity.getApplicationContext(), 0, intent, 0);

        IntentFilter[] filters = new IntentFilter[1];
        String[][] techList = new String[][]{};
        filters[0] = new IntentFilter();
        filters[0].addAction(NfcAdapter.ACTION_TAG_DISCOVERED);
        filters[0].addCategory(Intent.CATEGORY_DEFAULT);

        adapter.enableForegroundDispatch(activity, pendingIntent, filters, techList);
    }

    /**
     *
     * @param activity	The {BaseActivty} requesting to stop the foreground dispatch
     * @param adapter	The { NfcAdapter} used for the foreground dispatch
     */
    public static void stopForegroundDispatch(final Activity activity, NfcAdapter adapter) {
        adapter.disableForegroundDispatch(activity);
    }

    private class NfcVReaderIDTask extends AsyncTask<Tag, Void, String> {

        @Override
        protected String doInBackground(Tag... params) {
            Tag tag = params[0];
            NfcV nfcvTag = NfcV.get(tag);
            byte[] tagID = nfcvTag.getTag().getId();
            Log.d("Hex ID", toHex(tagID));
            return getHex(tagID);
        }
        /**
         *
         * @param bytes	Array of bytes read from {NfcV.get(Tag)}
         * @return String representing ID as Hex
         */
        public String toHex(byte[] bytes){
            String text=String.format("0x");
            for (byte  element : bytes) {
                text=text.concat(String.format("%02x", element));
            }
            return text;
        }

        private String getHex(byte[] bytes) {
            StringBuilder sb = new StringBuilder();
            for (byte b : bytes) {
                sb.append(String.format("%02X ", b));
            }
            return sb.toString();
        }
        @Override
        protected void onPostExecute(String result) {
            if (result != null) {
                textView.setText("Hex ID: " + result);
            }
        }
    }

    private class NfcVOpenTagTask extends AsyncTask<Tag, Void, Boolean>{

            @Override
            protected void onPostExecute(Boolean result) {
                super.onPostExecute(result);
                String message = (result) ? "OPEN OK" : "ERROR OPEN";
                Toast.makeText(getApplicationContext(), message, Toast.LENGTH_SHORT).show();
            }

            @Override
            protected Boolean doInBackground(Tag... params) {
                Tag tag = params[0];
                NfcV nfcvTag = NfcV.get(tag);
                try{
                    nfcvTag.connect();
                    byte[] cmd = new byte[] {
                            (byte)0x00, // Flags
                            (byte)0x21, // Command: Write multiple blocks
                            (byte)0x03,
                            (byte)0x69,
                            (byte)0x2E,
                            (byte)0x63,
                            (byte)0x6F
                    };
                    nfcvTag.transceive(cmd);
                    nfcvTag.close();
                }catch(IOException e){
                    e.printStackTrace();
                    return false;
                }
                return true;
            }
        }
    private class NfcVCloseTagTask extends AsyncTask<Tag, Void, Boolean>{

        @Override
        protected void onPostExecute(Boolean result) {
            super.onPostExecute(result);
            String message = (result) ? "CLOSE OK" : "ERROR CLOSE";
            Toast.makeText(getApplicationContext(), message, Toast.LENGTH_SHORT).show();
        }

        @Override
        protected Boolean doInBackground(Tag... params) {
            Tag tag = params[0];
            NfcV nfcvTag = NfcV.get(tag);
            try{
                nfcvTag.connect();
                byte[] cmd = new byte[] {
                        (byte)0x00, // Flags
                        (byte)0x21, // Command: Write multiple blocks
                        (byte)0x03,
                        (byte)0x69,
                        (byte)0x2E,
                        (byte)0x63,
                        (byte)0x32
                };
                nfcvTag.transceive(cmd);
                nfcvTag.close();
            }catch(IOException e){
                e.printStackTrace();
                return false;
            }
            return true;
        }
    }
    private class NfcVReaderBlockTask extends AsyncTask<Tag, Void, String> {
        @Override
        protected String doInBackground(Tag... params) {
            String result = "Init";
            Tag tag = params[0];
            NfcV nfcvTag = NfcV.get(tag);
            try {
                nfcvTag.connect();
            } catch (IOException e){
                String message = "Couldn't etablish connexion!";
                Toast.makeText(getApplicationContext(), message, Toast.LENGTH_SHORT).show();
            }

            try{
                // Get system information (0x2B)
                byte[] cmd = new byte[] {
                        (byte)0x00, // Flags
                        (byte)0x2B // Command: Get system information
                };
                byte[] systeminfo = nfcvTag.transceive(cmd);
                // Chop off the initial 0x00 byte:
                systeminfo = Arrays.copyOfRange(systeminfo, 1, 15);

                cmd = new byte[] {
                        (byte)0x00, // Flags
                        (byte)0x23, // Command: Read multiple blocks
                        (byte)0x00, // First block (offset)
                        (byte)0x05  // Number of blocks
                };
                byte[] userdata = nfcvTag.transceive(cmd);

                // Chop off the initial 0x00 byte:
                userdata = Arrays.copyOfRange(userdata, 1, 20);
                result = getHex(userdata);
                nfcvTag.close();
            }catch (IOException e){
                String message = "An error occurred while reading !";
                Toast.makeText(getApplicationContext(), message, Toast.LENGTH_SHORT).show();
            }
            return result;
        }
        /**
         *
         * @param bytes	Array of bytes read from {NfcV.get(Tag)}
         * @return String representing ID as Hex
         */
        public String toHex(byte[] bytes){
            String text=String.format("0x");
            for (byte  element : bytes) {
                text=text.concat(String.format("%02x", element));
            }
            return text;
        }

        private String getHex(byte[] bytes) {
            StringBuilder sb = new StringBuilder();
            for (byte b : bytes) {
                sb.append(String.format("%02X ", b));
            }
            return sb.toString();
        }

        @Override
        protected void onPostExecute(String result) {
            if (result != null) {
                Log.d("Blocks", result);
            }
        }
    }
}