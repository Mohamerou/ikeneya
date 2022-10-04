import { ComponentFixture, TestBed } from '@angular/core/testing';

import { WelcomeAreaComponent } from './welcome-area.component';

describe('WelcomeAreaComponent', () => {
  let component: WelcomeAreaComponent;
  let fixture: ComponentFixture<WelcomeAreaComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ WelcomeAreaComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(WelcomeAreaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
