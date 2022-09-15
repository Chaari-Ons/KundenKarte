import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {MainComponent} from './components/main/main.component';

const routes: Routes = [
  { path: '', component: MainComponent,
    children: [
      { path: 'markets', loadChildren: () => import('../features/market/market.module').then(m => m.MarketModule) },
      { path: 'users', loadChildren: () => import('../features/user/user.module').then(m => m.UserModule) },
      { path: 'dashboard', loadChildren: () => import('../features/dashboard/dashboard.module').then(m => m.DashboardModule) },
      {
        path: '',
        redirectTo: 'dashboard',
        pathMatch: 'full'
      }
    ]
  },

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class CoreRoutingModule { }
