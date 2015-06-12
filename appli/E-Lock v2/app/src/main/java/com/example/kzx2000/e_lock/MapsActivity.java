package com.example.kzx2000.e_lock;

import android.location.Criteria;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.support.v4.app.FragmentActivity;
import android.widget.Toast;
import com.google.android.gms.maps.CameraUpdate;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.GoogleMap.OnInfoWindowClickListener;
import com.google.android.gms.maps.LocationSource;
import com.google.android.gms.maps.MapFragment;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;

public class MapsActivity extends FragmentActivity implements
        OnMapReadyCallback, OnInfoWindowClickListener, LocationSource,
        LocationListener {
    private OnLocationChangedListener mapLocationListener=null;
    private LocationManager locMgr=null;
    private Criteria crit=new Criteria();
    private GoogleMap map=null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_maps);

            MapFragment mapFrag=
                    (MapFragment)getFragmentManager().findFragmentById(R.id.map);

            mapFrag.getMapAsync(this);
    }

    @Override
    public void onMapReady(final GoogleMap map) {
        this.map=map;
        map.setOnInfoWindowClickListener(this);
        locMgr=(LocationManager)getSystemService(LOCATION_SERVICE);
        crit.setAccuracy(Criteria.ACCURACY_FINE);
        locMgr.requestLocationUpdates(0L, 0.0f, crit, this, null);
        map.setLocationSource(this);
        map.setMyLocationEnabled(true);
        map.getUiSettings().setMyLocationButtonEnabled(true);
        CameraUpdate zoom = CameraUpdateFactory.zoomTo(15);
        map.animateCamera(zoom);
        //addMarker(map, 40.748963847316034, -73.96807193756104,
        //        R.string.btn_maps, R.string.btn_register);
    }

    @Override
    public void onResume() {
        super.onResume();

        if (locMgr!=null) {
            locMgr.requestLocationUpdates(0L, 0.0f, crit, this, null);
        }

        if (map!=null) {
            map.setLocationSource(this);
        }
    }

    @Override
    public void onPause() {
        map.setLocationSource(null);
        locMgr.removeUpdates(this);

        super.onPause();
    }

    @Override
    public void onInfoWindowClick(Marker marker) {
        Toast.makeText(this, marker.getTitle(), Toast.LENGTH_LONG).show();
    }

    @Override
    public void activate(OnLocationChangedListener listener) {
        this.mapLocationListener=listener;
    }

    @Override
    public void deactivate() {
        this.mapLocationListener=null;
    }

    @Override
    public void onLocationChanged(Location location) {
        if (mapLocationListener != null) {
            mapLocationListener.onLocationChanged(location);

            LatLng latlng=
                    new LatLng(location.getLatitude(), location.getLongitude());
            CameraUpdate cu=CameraUpdateFactory.newLatLng(latlng);

            map.animateCamera(cu);
        }
    }

    @Override
    public void onProviderDisabled(String provider) {
        // unused
    }

    @Override
    public void onProviderEnabled(String provider) {
        // unused
    }

    @Override
    public void onStatusChanged(String provider, int status, Bundle extras) {
        // unused
    }

    private void addMarker(GoogleMap map, double lat, double lon,
                           int title, int snippet) {
        map.addMarker(new MarkerOptions().position(new LatLng(lat, lon))
                .title(getString(title))
                .snippet(getString(snippet)));
    }
}