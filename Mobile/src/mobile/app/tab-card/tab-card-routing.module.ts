import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { TabCardPage } from './tab-card.page';
import {CardComponent} from "./components/card/card.component";
import {StoreComponent} from "./components/store/store.component";


const routes: Routes = [
  {
    path: '',
    component: TabCardPage,
    children: [
      {
        path: 'search-market',
        component: StoreComponent
      },
      {
      path: 'coupon',
      component: CardComponent
      },
      { path: '', pathMatch: 'full', redirectTo: 'search-market'},
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class TabCardPageRoutingModule {}
