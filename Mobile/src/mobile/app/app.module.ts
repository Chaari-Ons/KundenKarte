import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouteReuseStrategy } from '@angular/router';
import {HttpClientModule, HttpEvent, HttpHandler, HttpRequest} from '@angular/common/http';
import { IonicModule, IonicRouteStrategy } from '@ionic/angular';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {FormsModule} from '@angular/forms';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {LoginGuard} from "./guard/login.guard";
import {LogoutGuard} from "./guard/logout.guard";
import { Observable } from 'rxjs';


@NgModule({
  declarations: [AppComponent],
  entryComponents: [],
  imports: [
      BrowserModule,
      IonicModule.forRoot(),
      AppRoutingModule,
      FormsModule,
      HttpClientModule,
      BrowserAnimationsModule
  ],
  providers: [{ provide: RouteReuseStrategy, useClass: IonicRouteStrategy },
      LoginGuard,LogoutGuard],
  bootstrap: [AppComponent],
})
export class AppModule {

    intercept(req: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {

        const token = localStorage.getItem('token');



        if (!req.headers.has('Content-Type')) {

            req = req.clone({

                headers: req.headers.set('Content-Type', 'application/json')

            });

        }



        if (token) {

            // If we have a token, we set it to the header

            req = req.clone({

                setHeaders: { Authorization: `Authorization token ${token}` }

            });

        }



        return next.handle(req);

    }

}
