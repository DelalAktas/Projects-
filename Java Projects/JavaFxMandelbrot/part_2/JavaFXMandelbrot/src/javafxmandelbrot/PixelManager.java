/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package javafxmandelbrot;

import javafx.application.Platform;
import javafx.scene.canvas.GraphicsContext;

/**
 *
 * @author Joris
 */
public class PixelManager implements Runnable {

    private final GraphicsContext gc;
    private Pixel[] pixelArray;
    private int pixelCounter = 0;

    PixelManager(GraphicsContext gc, int size) {
        this.gc = gc;
        pixelArray = new Pixel[size];
    }

    public synchronized void add(Pixel p) {
        
        // TODO: add p to pixelArray
        if (this.pixelCounter<this.pixelArray.length){
            for (int i =0; i< pixelArray.length; i++){
                if (pixelArray[i]==null){
                    pixelArray[i]=p;
                    pixelCounter++;
                    System.out.println("X: "+ pixelArray[i].getX() +" Y: " + pixelArray[i].getY());
                    break;
                }
            }
        }
        else{
            this.show();
            try {
                wait();
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }
    }

    
    public synchronized void show() {
        // TODO: display all pixels in pixelArray[], and empty the array afterwards

            // hint: 
            // one pixel, displayed as a 1x1 rectangle
            // gc.setFill(p.getColor());
            // gc.fillRect(p.getX(), p.getY(), 1, 1);
        for (int i = 0; i<this.pixelArray.length;i++){
            gc.setFill(this.pixelArray[i].getColor());
            gc.fillRect(this.pixelArray[i].getX(), this.pixelArray[i].getY(), 1, 1);
        }
        Platform.runLater(this);
    }

    @Override
    public synchronized void run() {
        /*for (int i = 0; i<this.pixelArray.length;i++){

        }*/
        notifyAll();
    }
}

