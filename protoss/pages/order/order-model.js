import { Base } from '../../utils/base.js'

class Order extends Base {

  constructor() {
    super();
    this._storageKeyName = 'newOrder';
  }
}

export { Order };