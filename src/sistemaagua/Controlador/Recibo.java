/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package sistemaagua.Controlador;

import java.util.ArrayList;
import java.util.LinkedList;
import java.util.Queue;
//import sistemaagua.SistemaAgua;

/**
 *
 * @author Alan
 */
public class Recibo {
    private int idRecibo;
    private Duenio duenio;
    private int lecturaAnterior;
    private int lecturaActual;
    private int cubosConsumidos;
    private String fechaActual; //ingresar "17-04-2000"
    private String mes;
    private String anio;
    private double montoMensual;
    private double montoTotal;

    public Recibo(int idRecibo,String nombre, String apellidoPaterno, String apellidoMaterno, int lecturaActual,
                  String fechaActual, SistemaAgua sistema) {
        if (buscarDueño(nombre, apellidoPaterno,apellidoMaterno, sistema) != null){
            this.idRecibo = idRecibo;
            this.duenio = buscarDueño(nombre, apellidoPaterno,apellidoMaterno, sistema);
            this.lecturaActual = lecturaActual;
            lecturaAnterior = duenio.getLectura();
            duenio.setLectura(lecturaActual);
            cubosConsumidos = lecturaActual - lecturaAnterior;
            montoMensual = calcularDeudaMensual();
            montoTotal = calcularMonto(duenio);
            this.fechaActual = fechaActual;
            String partes[] = fechaActual.split("-");
            mes = partes[1];
            anio = partes[2];
        }else {
            System.out.println("No se puede realizar el recibo, el dueño no esta registrado.");
        }
    }

    public Duenio buscarDueño(String nombre, String apellidoPaterno, String apellidoMaterno, SistemaAgua sistemaAgua){
        ArrayList<Duenio> duenios = sistemaAgua.getDuenios();
        Duenio d = null;
        boolean encontrado = false;
        for (int i = 0; i<duenios.size() && !encontrado; i++){
            if (duenios.get(i).getNombre().equals(nombre) && duenios.get(i).getApellidoPaterno().equals(apellidoPaterno)
                    && duenios.get(i).getApellidoMaterno().equals(apellidoMaterno))
                d = duenios.get(i);
            encontrado = true;
        }
        return d;
    }

    private double calcularDeudaMensual(){
        if (cubosConsumidos >= 0 && cubosConsumidos < 11)
          return 10;
        else if (cubosConsumidos >= 11 && cubosConsumidos < 21)
            return cubosConsumidos*1.05;
        else if (cubosConsumidos >= 21 && cubosConsumidos < 31)
            return cubosConsumidos*1.1;
        else if (cubosConsumidos >= 31 && cubosConsumidos < 41)
            return cubosConsumidos*1.2;
        else if (cubosConsumidos >= 41 && cubosConsumidos < 51)
            return cubosConsumidos*1.3;
        else if (cubosConsumidos >= 51 && cubosConsumidos < 101)
            return cubosConsumidos*1.5;
        else
            return -1;
    }


    private double calcularMonto (Duenio dueño) {
        Deuda deuda = duenio.getDeuda();
        Queue<Recibo> recibos = deuda.getRecibos();
        if (!recibos.isEmpty()) {
            for (Recibo recibo : recibos) {
                montoTotal += recibo.getMontoMensual();
            }
        }
        return montoTotal + montoMensual;
    }

    public double getMontoMensual() {
        return montoMensual;
    }

    public void setMontoMensual(double montoMensual) {
        this.montoMensual = montoMensual;
    }

    public String getAño() {
        return anio;
    }

    public String getMes() {
        return mes;
    }

    @Override
    public String toString() {
        return "Recibo{" +
                "idRecibo=" + idRecibo +
                ", dueño=" + duenio +
                ", lecturaAnterior=" + lecturaAnterior +
                ", lecturaActual=" + lecturaActual +
                ", cubosConsumidos=" + cubosConsumidos +
                ", fechaActual='" + fechaActual + '\'' +
                ", mes='" + mes + '\'' +
                ", añio='" + anio + '\'' +
                ", montoMensual=" + montoMensual +
                ", montoTotal=" + montoTotal +
                '}';
    }
    
}
