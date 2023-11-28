<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class VehicleController extends Controller
{

    //TODO VIEW VEHICLE
    public function view()
    {
        $admin_id = Auth::user()->admin_id;
        $sum = Vehicle::where('admin_id', $admin_id)->sum('stock');
        $vehicles = Vehicle::where('admin_id', $admin_id)->paginate(5);
        if ($vehicles->isEmpty()) {
            Alert::info('Info Detail Booking', 'Kendaraan Masih Kosong');
            return view('admin.vehicle', compact('vehicles', 'sum'));
        }
        return view('admin.vehicle', compact('vehicles', 'sum'));
    }
    //TODO View Form CREATE VEHICLE
    public function create()
    {
        $vehicles = Vehicle::where('admin_id', Auth::user()->admin_id)->orderBy('updated_at', 'DESC')->get();
        return view('admin.createVehicle', compact('vehicles'));
    }
    //TODO Post  ADD NEW VEHICLE
    public function createVehicle(request $request)
    {
        $admin = Admin::where('admin_id', Auth::user()->admin_id)->first();

        if (Hash::check($request->password, $admin->password)) {
            $uploadedFileUrl = cloudinary()->upload($request->file('photo')->getRealPath(), ['folder' => 'penyewaan','transformation' => [
                'width' => 300, 
                'height' => 200, 
                'crop' => 'fill' 
            ]])->getSecurePath();
            $vehicle = new Vehicle();
            $vehicle->admin_id = Auth::user()->admin_id;
            $vehicle->name = $request->input('name');
            $vehicle->stock = $request->input('stock');
            $vehicle->type = $request->input('type');
            $vehicle->charter_price = $request->input('charter_price');
            $vehicle->status = 'Tersedia';
            $vehicle->description = $request->input('description');
            $vehicle->vehicle_photo = $uploadedFileUrl;
            $vehicle->created_at = now();
            $vehicle->save();
            
            Alert::success('Kendaraan', 'Kendaraan Baru berhasil di buat');

            return redirect(route('createvehicle'));
        } else {
            return redirect(route('createvehicle'));
        }
    }
    //TODO DELETE VEHICLE
    public function delete(request $Request)
    {
        $vehicleId = $Request->vehicle_id;
        $vehicle = Vehicle::find($vehicleId);

        if ($vehicle) {
            $vehicle->delete();
            Alert::success('Kendaraan', 'Kendaraan berhasil dihapus');

            return redirect(route('viewVehicle'));
        } else {
            return redirect(route('viewVehicle'));
        }
    }

    //TODO View Detail Vehicle
    public function viewDetailVehicle(request $request)
    {
        $vehicleId = $request->vehicle_id;
        $vehicleold = Vehicle::find($vehicleId);
        $vehicles = Vehicle::where('admin_id', Auth::user()->admin_id)->orderBy('updated_at', 'DESC')->get();

        return view('admin.detailVehicle', compact('vehicles', 'vehicleold'));
    }
    //TODO View Update Vehicle
    public function viewUpdateVehicle(request $request)
    {
        $vehicleId = $request->vehicle_id;
        $vehicleold = Vehicle::find($vehicleId);
        $vehicles = Vehicle::where('admin_id', Auth::user()->admin_id)->orderBy('updated_at', 'DESC')->get();
        return view('admin.updateVehicle', compact('vehicles', 'vehicleold'));
    }
    //TODO POST Update Vehicle
    public function updateVehicle(request $request)
    {
        $vehicleid = $request->input('vehicle_id');
        $vehicle = Vehicle::find($vehicleid);

        $admin = Admin::where('admin_id', Auth::user()->admin_id)->first();
        if (Hash::check($request->password, $admin->password)) {
            if ($request->file('photo') != null) {
                $uploadedFileUrl = cloudinary()->upload($request->file('photo')->getRealPath(), ['folder' => 'penyewaan', 'transformation' => [
        'width' => 300, 
        'height' => 200, 
        'crop' => 'fill' 
    ]])->getSecurePath();

                $vehicle->update(
                    [
                        'name' => $request->input('name'),
                        'type' => $request->input('type'),
                        'stock' => $request->input('stock'),
                        'charter_price' => $request->input('charter_price'),
                        'status' => $request->input('status'),
                        'description' => $request->input('description'),
                        'vehicle_photo' => $uploadedFileUrl,
                        'updated_at' => now(),
                    ]
                );
                Alert::success('Kendaraan Berhasil diupdate', 'semoga semakin cuan');
                return redirect(route('admindetailvehicle', ['vehicle_id' => $vehicleid]));
            } else {
                $vehicle->update(
                    [
                        'name' => $request->input('name'),
                        'type' => $request->input('type'),
                        'stock' => $request->input('stock'),
                        'charter_price' => $request->input('charter_price'),
                        'status' => $request->input('status'),
                        'description' => $request->input('description'),
                        'updated_at' => now(),
                    ]
                );
                Alert::success('Kendaraan Berhasil diupdate', 'semoga semakin cuan');
                return redirect(route('admindetailvehicle', ['vehicle_id' => $vehicleid]));
            }
        }
        Alert::error('Kendaraan Gagal diupdate', 'silakan cek password yang di masukkan');

        return redirect(route('admindetailvehicle', ['vehicle_id' => $vehicleid]));
    }
}
