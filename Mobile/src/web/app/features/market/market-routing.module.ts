import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';

import {MarketComponent} from './market.component';
import {ListMarketBranchesComponent} from './components/list-market-branches/list-market-branches.component';

const routes: Routes = [
  {
    path: '',
    component: MarketComponent,
  },
  {
    path: 'list-market-branches/:url',
    component: ListMarketBranchesComponent
  }];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class MarketRoutingModule {
}
