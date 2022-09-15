import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MarketBranchService {

  constructor(private httpClient: HttpClient) { }

  public saveMarketBranch(data, marketId) {
    return this.httpClient.post(environment.urlAPI + '/market-branches/'+marketId+'/'+data.city, data);
  }

  public updateMarketBranch(formData ,marketBranchId) {
    formData.city = formData.city.id;
    return this.httpClient.put(environment.urlAPI + '/market-branches/'+marketBranchId,formData);
  }
}
