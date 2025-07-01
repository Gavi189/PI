"use client";

import { ICart } from "@/interfaces/ICart";
import CartItem from "./cart-item";

interface CartListProps {
  cart: ICart;
  onUpdateQuantity: (productId: number, quantity: number) => void;
  onRemove: (productId: number) => void;
}

const CartList: React.FC<CartListProps> = ({
  cart,
  onUpdateQuantity,
  onRemove,
}) => {
  return (
    <div>
      {cart.items.length === 0 ? (
        <p>O carrinho está vazio.</p>
      ) : (
        cart.items.map((item, index) => (
          <CartItem
            key={`${item.product.id_produto}-${index}`} // Chave única combinando id_produto e índice
            item={item}
            onUpdateQuantity={onUpdateQuantity}
            onRemove={onRemove}
          />
        ))
      )}
    </div>
  );
};

export default CartList;
