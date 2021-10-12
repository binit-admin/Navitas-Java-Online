package jdoodle;


import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class api {
    public static void main(String args[]) {

        
        
            
        String clientId = "f09ff16aed0322f99d5051c1076667b5"; 
        String clientSecret = "36bbfab973fb73461c12dcb4acaf90e3896e687e563845ddfc10444756e1516e"; 
        String script = "shishir";
        String language = "java";
        String versionIndex = "3";

        try {
            URL url = new URL("https://api.jdoodle.com/v1/execute");
            HttpURLConnection connection = (HttpURLConnection) url.openConnection();
            connection.setDoOutput(true);
            connection.setRequestMethod("POST");
            connection.setRequestProperty("Content-Type", "application/json");

            String input1 = "{\"clientId\": \"" + clientId + "\",\"clientSecret\":\"" + clientSecret; 
            String input2 =  "\",\"script\":\"" + script +
            "\",\"language\":\"" + language + "\",\"versionIndex\":\"" + versionIndex + "\"} ";

            String input = input1  +  input2;
            System.out.println(input2);

            OutputStream outputStream = connection.getOutputStream();
            outputStream.write(input.getBytes());
            outputStream.flush();

            if (connection.getResponseCode() != HttpURLConnection.HTTP_OK) {
                throw new RuntimeException("Please check your inputs : HTTP error code : "+ connection.getResponseCode());
            }

            BufferedReader bufferedReader;
            bufferedReader = new BufferedReader(new InputStreamReader(
            (connection.getInputStream())));

            String output;
            System.out.println("Output from JDoodle .... \n");
            while ((output = bufferedReader.readLine()) != null) {
                System.out.println(output);
            }

            connection.disconnect();

        } catch (MalformedURLException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}