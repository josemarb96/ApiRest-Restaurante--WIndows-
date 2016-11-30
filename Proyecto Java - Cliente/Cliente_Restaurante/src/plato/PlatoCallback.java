package plato;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

import java.util.Vector;

import okhttp3.Headers;

public class PlatoCallback implements Callback<Vector<Plato>> //Array-vector con los platos
{
	@Override
	public void onFailure(Call<Vector<Plato>> arg0, Throwable arg1) 
	{
		int i;
		i=0;
		
	}

	@Override
	public void onResponse(Call<Vector<Plato>> arg0, Response<Vector<Plato>> resp) 
	{
		Vector<Plato> platos;
		String contentPlato;
		int code;
		String message;
		boolean isSuccesful;
		
		platos = resp.body();
		
		Headers cabeceras = resp.headers();
		contentPlato = cabeceras.get("Content-Plato");
		code = resp.code();
		message = resp.message();
		isSuccesful = resp.isSuccessful();
		
		System.out.println(platos.get(0).getIdPlato()+", "+platos.get(0).getNombrePlato());
	}
}