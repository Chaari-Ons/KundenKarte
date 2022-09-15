import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {environment} from 'src/environments/environment';
import {Observable} from 'rxjs';
import {Market} from '../../../models/Market';

@Injectable({
  providedIn: 'root'
})
export class MarketService {

  constructor(private httpClient: HttpClient) { }

  public getMarkets(): Observable<Market> {
    const bodyRequest = {relations: []};
    return this.httpClient.post<Market>(environment.urlAPI + '/markets/relations', bodyRequest);
  }

  public getMarketsById(idMarket): Observable<Market> {
    const bodyRequest = {relations: ['marketBranches']};
    return this.httpClient.post<Market>(environment.urlAPI + '/markets/'+idMarket+'/relations', bodyRequest);
  }

  public createMarket(formData) {
    return this.httpClient.post(environment.urlAPI + '/markets', formData);
  }

  public updateMarket(formData, marketId) {
    return this.httpClient.put(environment.urlAPI + '/markets/'+marketId, formData);
  }

  public deleteMarkets(marketId) {
    return this.httpClient.delete<Market>(environment.urlAPI + '/markets/'+marketId);
  }
}
