package plato;

import java.util.Vector;

import retrofit2.Call;
import retrofit2.http.GET;
import retrofit2.http.Path;

public interface PlatoInterface 
{
	@GET("plato/{idPlato}/")
	Call<Vector<Plato>> getPlato (@Path("idPlato") int idPlato);
}