import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NosDocteursComponent } from './nos-docteurs.component';

describe('NosDocteursComponent', () => {
  let component: NosDocteursComponent;
  let fixture: ComponentFixture<NosDocteursComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ NosDocteursComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(NosDocteursComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
