"use client";

import { ICartItem } from "@/interfaces/ICart";

interface CartItemProps {
  item: ICartItem;
  onUpdateQuantity: (productId: number, delta: number) => void;
  onRemove: (productId: number) => void;
}

const CartItem: React.FC<CartItemProps> = ({
  item,
  onUpdateQuantity,
  onRemove,
}) => {
  const handleQuantityChange = async (delta: number) => {
    try {
      const newQuantity = item.quantity + delta;
      if (newQuantity >= 0) {
        await onUpdateQuantity(item.product.id_produto, delta);
      } else {
        await onRemove(item.product.id_produto);
      }
    } catch (error) {
      console.error("Falha ao atualizar quantidade:", error);
      alert("Erro ao atualizar a quantidade. Verifique o console.");
    }
  };

  return (
    <div className="flex items-center justify-between py-2 border-b">
      <span>
        {item.product.produto} (x{item.quantity}) - R${" "}
        {(item.product.preco! * item.quantity).toFixed(2)}
      </span>
      <div className="flex gap-2">
        <button
          onClick={() => handleQuantityChange(-1)}
          className="border px-2"
        >
          -
        </button>
        <span>{item.quantity}</span>
        <button onClick={() => handleQuantityChange(1)} className="border px-2">
          +
        </button>
        <button
          onClick={() => onRemove(item.product.id_produto)}
          className="border px-2 text-red-500"
        >
          Remover
        </button>
      </div>
    </div>
  );
};

export default CartItem;
