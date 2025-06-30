"use client";

import { ICart } from "@/interfaces/ICart";
import CartItem from "./cart-item";

interface CartListProps {
  cart: ICart;
  onUpdateQuantity: (productId: number, quantity: number) => void;
  onRemove: (productId: number) => void;
}

const CartList = ({ cart, onUpdateQuantity, onRemove }: CartListProps) => {
  return (
    <div className="w-full max-w-screen-xl mx-auto px-4">
      {cart.items.length === 0 ? (
        <p className="text-center text-gray-600">Seu carrinho está vazio.</p>
      ) : (
        <div>
          {cart.items.map((item) => (
            <CartItem
              key={item.product.id_produto}
              item={item}
              onUpdateQuantity={onUpdateQuantity}
              onRemove={onRemove}
            />
          ))}
          <div className="mt-4 text-right">
            <p className="text-xl font-semibold">Total: R$ {cart.total}</p>
          </div>
        </div>
      )}
    </div>
  );
};

export default CartList;
