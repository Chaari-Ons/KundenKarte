import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Observable} from 'rxjs';
import {environment} from '../../../../../environments/environment';
import {City} from '../../../models/city.model';

@Injectable({
  providedIn: 'root'
})
export class CityService {

  constructor(private httpClient: HttpClient) { }

  public getCities(): Observable<City> {
    return this.httpClient.get<City>(environment.urlAPI + '/cities');
  }
}
