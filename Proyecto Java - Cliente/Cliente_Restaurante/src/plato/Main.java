package plato;

import java.io.IOException;
import com.google.gson.Gson;
import okio.*;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;

public class Main 
{
	private final static String SERVER_URL = "http://restaurante.dev/";
	
	public static void main(String[] args) 
	{
		Retrofit retrofit;
		PlatoCallback platoCallback = new PlatoCallback();
		
		retrofit = new Retrofit.Builder()
							   .baseUrl(SERVER_URL)
							   .addConverterFactory(GsonConverterFactory.create())
							   .build();
		
		PlatoInterface platoInter = retrofit.create(PlatoInterface.class);
		
		platoInter.getPlato(3).enqueue(platoCallback); //El (3) es el idPlato que quiero ver
	}
}
