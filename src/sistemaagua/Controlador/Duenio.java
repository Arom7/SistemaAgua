/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package sistemaagua.Controlador;

import java.util.Queue;
import java.util.Scanner;

/**
 *
 * @author Alan
 */
public class Duenio {
    private int iDuenio;
    private String nombre;
    private String apellidoPaterno;
    private String apellidoMaterno;
    private int telefono;
    private int lectura;
    private Deuda deuda;

    public Duenio(int iDuenio, String nombre, String apellidoPaterno, String apellidoMaterno, int telefono) {
        this.iDuenio = iDuenio;
        this.nombre = nombre;
        this.apellidoPaterno = apellidoPaterno;
        this.apellidoMaterno = apellidoMaterno;
        this.telefono = telefono;
        this.lectura = 0;
        deuda = new Deuda();
    }

    public int getiDueño() {
        return iDuenio;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getApellidoPaterno() {
        return apellidoPaterno;
    }

    public void setApellidoPaterno(String apellidoPaterno) {
        this.apellidoPaterno = apellidoPaterno;
    }

    public String getApellidoMaterno() {
        return apellidoMaterno;
    }

    public void setApellidoMaterno(String apellidoMaterno) {
        this.apellidoMaterno = apellidoMaterno;
    }

    public int getTelefono() {
        return telefono;
    }

    public void setTelefono(int telefono) {
        this.telefono = telefono;
    }

    public int getLectura() {
        return lectura;
    }

    public void setLectura(int lectura) {
        this.lectura = lectura;
    }

    public Deuda getDeuda() {
        return deuda;
    }

    @Override
    public String toString() {
        return "Dueño{" +
                "iDueño=" + iDuenio +
                ", nombre='" + nombre + '\'' +
                ", apellidoPaterno='" + apellidoPaterno + '\'' +
                ", apellidoMaterno='" + apellidoMaterno + '\'' +
                ", telefono=" + telefono +
                '}';
    }

    public void pagar (){
        System.out.println("¿Cuantos meses va a pagar? : ");
        Scanner sc = new Scanner(System.in);
        int total = 0;
        int mesesPagar = Integer.parseInt(sc.nextLine());
        for (int i = 0 ; i < mesesPagar ; i++){
            Recibo recibo = (Recibo) deuda.getRecibos().poll();
            Factura factura = new Factura(iDuenio, recibo.getMontoMensual(),recibo.getMes(), recibo.getAño());
            total += recibo.getMontoMensual();
            deuda.añadirFactura(factura);
        }
        System.out.println("Monto total a pagar: " + total);
    }

    public void mostrarDeuda(){
       if (deuda == null || deuda.getRecibos().isEmpty()){
           System.out.println("No tiene deudas");
       }else {
           Queue<Recibo> recibos = deuda.getRecibos();
            for (Recibo recibo : recibos){
                System.out.println(recibo.toString());
            }
       }
    }

    
}
