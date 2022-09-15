import { IonicModule } from '@ionic/angular';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { SwiperModule } from 'swiper/angular';
import { TabBrochuresPage } from './tab-brochures.page';
import { ExploreContainerComponentModule } from '../explore-container/explore-container.module';

import { TabBrochuresPageRoutingModule } from './tab-brochures-routing.module';
import {CatalogueComponent} from './components/catalogue/catalogue.component';
import {ListBrochuresComponent} from './components/list-brochures/list-brochures.component';
import {MatNativeDateModule} from '@angular/material/core';
import {DragDropModule} from '@angular/cdk/drag-drop';
import {LoginGuard} from '../guard/login.guard';
import { NgxIonicImageViewerModule } from 'ngx-ionic-image-viewer';


@NgModule({
  imports: [
    IonicModule,
    CommonModule,
    FormsModule,
    ExploreContainerComponentModule,
    TabBrochuresPageRoutingModule,
    SwiperModule,
    MatNativeDateModule,
    DragDropModule,
    NgxIonicImageViewerModule

  ],  providers: [
    LoginGuard
  ],
  declarations: [TabBrochuresPage,ListBrochuresComponent,CatalogueComponent],
})
export class TabBrochuresPageModule {}
