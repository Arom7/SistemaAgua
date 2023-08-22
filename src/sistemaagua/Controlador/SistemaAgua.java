/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package sistemaagua.Controlador;

import java.util.ArrayList;
import java.util.Scanner;

/**
 *
 * @author Alan
 */
public class SistemaAgua {
    private ArrayList<Duenio>duenios;

    public SistemaAgua() {
        duenios = new ArrayList<>();
    }

    public ArrayList<Duenio> getDuenios() {
        return duenios;
    }
    public ArrayList<Duenio> getDueños() {
        return duenios;
    }

    public void agregarDueño(Duenio duenio){
        duenios.add(duenio);
    }

    public void modificarDatosDueño(Duenio dueño){
        String nombreBuscar = dueño.getNombre();
        String apellidoPaternoBuscar = dueño.getApellidoPaterno();
        String apellidoMaternoBuscar = dueño.getApellidoMaterno();
        boolean encontrado = false;
        for (int i = 0 ; i < duenios.size() && !encontrado ; i++){
            if (duenios.get(i).getNombre().equals(nombreBuscar)){
                if (duenios.get(i).getApellidoPaterno().equals(apellidoPaternoBuscar)) {
                    if (duenios.get(i).getApellidoMaterno().equals(apellidoMaternoBuscar)){
                        dueño.setApellidoMaterno(apellidoMaternoBuscar);
                        dueño.setApellidoPaterno(apellidoPaternoBuscar);
                        dueño.setNombre(nombreBuscar);
                        encontrado = true;
                    }
                }
            }
        }
    }
    public void funcionesLecturador(int opcion){
        boolean continuar = true;
        Scanner escaner = new Scanner (System.in);
        do {
            switch (opcion){
                case 1:
                    //realizar lectura
                    if (!this.getDuenios().isEmpty()) {
                        System.out.print("Ingresar id del recibo: ");
                        int id = Integer.parseInt(escaner.nextLine());
                        System.out.print("Ingrese el nombre del dueño: ");
                        String nombre = escaner.nextLine();
                        System.out.print("Ingrese el apellido paterno del dueño: ");
                        String apellido1 = escaner.nextLine();
                        System.out.print("Ingrese el apellido materno del dueño: ");
                        String apellido2 = escaner.nextLine();
                        System.out.print("Ingrese la lectura del medidor actual: ");
                        int lectura = Integer.parseInt(escaner.nextLine());
                        System.out.print("ingrese la fecha de lectura: (formato: dd-mm-aaaa): ");
                        String fecha = escaner.nextLine();
                        Recibo recibo = new Recibo(id, nombre, apellido1, apellido2, lectura, fecha, this);
                        Duenio duenio = buscarDueño(nombre, apellido1, apellido2);
                        duenio.getDeuda().añadirRecibo(recibo);
                        System.out.println(recibo.toString());
                    } else
                        System.out.print("La lista de dueños esta vacia");
                    break;
                case 2:
                    System.out.println("Volviendo al menu principal");
                    continuar = false;
                    break;
                default:
                    System.out.println("Dato no registrado, volviendo al menu principal.");
                    continuar = false;
            }
            System.out.print("Desea continuar (si/no): ");
            String respuesta = escaner.nextLine();
            if (!respuesta.equals("si"))
                continuar = false;
        } while (continuar);
    }
    public void funcionesDueño(int opcion) {
        Scanner escaner = new Scanner (System.in);
        boolean continuar = true;
        System.out.print("\tIngrese sus datos. \nIngrese su nombre: ");
        String nombre = escaner.nextLine();
        System.out.print("Ingrese su apellido paterno: ");
        String apellido1 = escaner.nextLine();
        System.out.print("Ingrese su apellido materno: ");
        String apellido2 = escaner.nextLine();
        Duenio duenio = buscarDueño(nombre,apellido1,apellido2);
        do {
            switch (opcion) {
                case 1:
                    if (duenio != null)
                        duenio.pagar();
                    else
                        System.out.print("Dueño no encontrado, ingrese bien sus datos.");
                    break;
                case 2:
                    if (duenio != null)
                        duenio.mostrarDeuda();
                    else
                        System.out.print("Dueño no encontrado, ingrese bien sus datos.");
                    break;
                case 3:
                    System.out.println("Volviendo al menu principal.");
                    continuar = false;
                    break;
                default:
                    System.out.println("Dato no registrado, volviendo al menu principal.");
                    continuar = false;
            }
            System.out.print("Desea continuar (si/no): ");
            String respuesta = escaner.nextLine();
            if (!respuesta.equals("si"))
                continuar = false;
        } while (continuar);
    }

    public Duenio buscarDueño(String nombre, String apellidoPaterno, String apellidoMaterno){
        ArrayList<Duenio> duenios = this.getDuenios();
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
}
