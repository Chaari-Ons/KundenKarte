import { IonicModule } from '@ionic/angular';
import { RouterModule } from '@angular/router';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { TabCardPage } from './tab-card.page';
import { ExploreContainerComponentModule } from '../explore-container/explore-container.module';

import { TabCardPageRoutingModule } from './tab-card-routing.module';
import {StoreComponent} from "./components/store/store.component";
import {CardComponent} from "./components/card/card.component";

@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ExploreContainerComponentModule,
    TabCardPageRoutingModule
  ],
  declarations: [TabCardPage, StoreComponent, CardComponent]
})
export class TabCardPageModule {}
